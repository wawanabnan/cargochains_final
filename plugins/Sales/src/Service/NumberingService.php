<?php
declare(strict_types=1);

namespace Sales\Service;

use Cake\I18n\FrozenDate;
use Cake\ORM\Locator\TableLocator;

class NumberingService
{
    public function __construct(
        private ?TableLocator $locator = null
    ) {
        $this->locator ??= new TableLocator();
    }

    public function generate(string $businessType, ?\DateTimeInterface $date = null, array $opts = []): string
    {
        $date ??= FrozenDate::today();
        $reset   = $opts['reset']   ?? 'month';
        $prefix  = $opts['prefix']  ?? $this->defaultPrefix($businessType);
        $padding = (int)($opts['padding'] ?? 4);
        $format  = $opts['format']  ?? '{PREFIX}-{YYYY}{MM}-{SEQ}';

        $period  = $this->periodKey($reset, $date);

        $Sequences = $this->locator->get('Sales.SalesNumberSequences');
        $conn = $Sequences->getConnection();

        $conn->begin();
        try {
            $row = $Sequences->find()
                ->where(['business_type' => $businessType, 'period' => $period])
                ->first();

            if (!$row) {
                $row = $Sequences->newEntity([
                    'business_type' => $businessType,
                    'period'        => $period,
                    'prefix'        => $prefix,
                    'padding'       => $padding,
                    'last_no'       => 0,
                ]);
                $Sequences->saveOrFail($row);
            }

            $next = $row->last_no + 1;
            $Sequences->query()
                ->update()
                ->set(['last_no' => $next, 'modified' => date('Y-m-d H:i:s')])
                ->where(['id' => $row->id])
                ->execute();

            $conn->commit();

            return $this->renderFormat($format, $prefix, $date, $next, $padding);

        } catch (\Throwable $e) {
            $conn->rollback();
            throw $e;
        }
    }

    private function defaultPrefix(string $businessType): string
    {
        return match (strtolower($businessType)) {
            'quotation' => 'QTN',
            'order'     => 'SO',
            default     => strtoupper(substr($businessType, 0, 3)),
        };
    }

    private function periodKey(string $reset, \DateTimeInterface $d): string
    {
        return match ($reset) {
            'month' => $d->format('Ym'),
            'year'  => $d->format('Y'),
            'none'  => 'ALL',
            default => $d->format('Ym'),
        };
    }

    private function renderFormat(string $fmt, string $prefix, \DateTimeInterface $d, int $seq, int $pad): string
    {
        $map = [
            '{PREFIX}' => $prefix,
            '{YYYY}'   => $d->format('Y'),
            '{YY}'     => $d->format('y'),
            '{MM}'     => $d->format('m'),
            '{DD}'     => $d->format('d'),
            '{SEQ}'    => str_pad((string)$seq, $pad, '0', STR_PAD_LEFT),
        ];
        return strtr($fmt, $map);
    }
}
