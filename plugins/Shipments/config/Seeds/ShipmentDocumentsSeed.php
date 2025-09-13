<?php
use Migrations\AbstractSeed;

class ShipmentDocumentsSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $data = [[
            'id' => 1,
            'shipment_id' => 1,
            'doc_type' => 'Invoice',
            'file_path' => '/files/docs/SHP-2025-0001/invoice.pdf',
            'note' => 'Proforma',
            'created' => $now,
            'modified' => $now,
        ]];
        $this->table('shipment_documents')->insert($data)->save();
    }
}
