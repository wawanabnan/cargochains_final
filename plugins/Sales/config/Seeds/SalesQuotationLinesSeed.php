<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class SalesQuotationLinesSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->table('sales_quotation_lines')->truncate();

        $quotes = $this->fetchAll('SELECT id FROM sales_quotations');
        $geoPool = [1,2,3,4,5]; // sesuaikan dgn geo_locations.id

        $rows = [];
        $now = date('Y-m-d H:i:s');

        foreach ($quotes as $q) {
            $qid = (int)$q['id'];
            $lineCount = rand(1, 4);

            for ($n = 1; $n <= $lineCount; $n++) {
                $origin = $geoPool[array_rand($geoPool)];
                do { $dest = $geoPool[array_rand($geoPool)]; } while ($dest === $origin);

                $qty   = rand(1, 10);
                $price = rand(50, 500) * 1000;

                $rows[] = [
                    'sales_quotation_id' => $qid,
                    'origin_id'          => $origin,
                    'destination_id'     => $dest,
                    'description'        => "Freight service #$n for Q$qid",
                    'qty'                => $qty,
                    'price'              => $price,
                    'amount'             => $qty * $price,
                    'created'            => $now,
                    'modified'           => $now,
                ];
            }
        }

        if ($rows) {
            $this->table('sales_quotation_lines')->insert($rows)->save();
        }
    }
}
