<?php
use Migrations\AbstractSeed;

class SalesSeed extends AbstractSeed
{
    public function run(): void
    {
        // ---- Bersihkan data lama + reset autoincrement (SQLite) ----
        $this->execute('PRAGMA foreign_keys = OFF');
        foreach (['sales_quotation_lines','sales_quotations','sales_order_lines','sales_orders'] as $t) {
            $this->execute("DELETE FROM {$t}");
        }
        // reset seq (khusus SQLite)
        $this->execute("DELETE FROM sqlite_sequence WHERE name IN ('sales_quotation_lines','sales_quotations','sales_order_lines','sales_orders')");
        $this->execute('PRAGMA foreign_keys = ON');

        $now = date('Y-m-d H:i:s');

        // ---- Quotations ----
        $this->table('sales_quotations')->insert([
            [
                // 'id' => (biarkan kosong)
                'number'       => 'Q-2025-0001',
                'customer_id'  => 1,
                'date'         => date('Y-m-d'),
                'currency'     => 'USD',
                'subtotal'     => 1500,
                'tax_total'    => 150,
                'grand_total'  => 1650,
                'status'       => 'DRAFT',
                'created'      => $now,
                'modified'     => $now,
            ],
        ])->save();

        // Ambil ID quotation yang baru dibuat
        $quoteId = (int)$this->fetchRow('SELECT id FROM sales_quotations WHERE number = "Q-2025-0001"')['id'];

        $this->table('sales_quotation_lines')->insert([
            [
                'sales_quotation_id' => $quoteId,
                'origin_id'          => 10,
                'destination_id'     => 20,
                'description'        => 'Jakarta → Singapore, 1x40FT Container',
                'qty'                => 1,
                'price'              => 1000,
                'amount'             => 1000,
                'created'            => $now,
                'modified'           => $now,
            ],
            [
                'sales_quotation_id' => $quoteId,
                'origin_id'          => 10,
                'destination_id'     => 30,
                'description'        => 'Jakarta → Port Klang, LCL 10 CBM',
                'qty'                => 10,
                'price'              => 50,
                'amount'             => 500,
                'created'            => $now,
                'modified'           => $now,
            ],
        ])->save();

        // ---- Orders ----
        $this->table('sales_orders')->insert([
            [
                'number'       => 'SO-2025-0001',
                'customer_id'  => 1,
                'date'         => date('Y-m-d'),
                'currency'     => 'USD',
                'subtotal'     => 500,
                'tax_total'    => 50,
                'grand_total'  => 550,
                'status'       => 'DRAFT',
                'created'      => $now,
                'modified'     => $now,
            ],
        ])->save();

        $orderId = (int)$this->fetchRow('SELECT id FROM sales_orders WHERE number = "SO-2025-0001"')['id'];

        $this->table('sales_order_lines')->insert([
            [
                'sales_order_id'  => $orderId,
                'origin_id'       => 40,
                'destination_id'  => 50,
                'description'     => 'Medan → Penang, Truck + Ferry',
                'qty'             => 1,
                'price'           => 500,
                'amount'          => 500,
                'created'         => $now,
                'modified'        => $now,
            ],
        ])->save();
    }
}
