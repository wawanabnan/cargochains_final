<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

class StatusHelper extends Helper
{
    public function badge(?string $status): string
    {
        if (!$status) {
            return '<span class="badge bg-dark">N/A</span>';
        }

        $status = strtoupper($status);

        $classes = [
            'DRAFT'     => 'bg-secondary',
            'SENT'      => 'bg-info text-dark',
            'CONFIRMED' => 'bg-primary',
            'APPROVED'  => 'bg-success',
            'CANCELED'  => 'bg-danger',
        ];

        $class = $classes[$status] ?? 'bg-dark';

        return sprintf('<span class="badge %s">%s</span>', $class, h($status));
    }
	
	 public function class($status)
    {
        $status = $status ?: '';
        $class  = isset($this->map[$status]) ? $this->map[$status] : 'secondary';
        return 'bg-' . $class;
    }
}
