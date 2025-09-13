<?php
declare(strict_types=1);

namespace Shipments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ShipmentDocumentsFixture extends TestFixture
{
    public string $table = 'shipment_documents';

    public array $records = [[
        'id' => 1,
        'shipment_id' => 1,
        'doc_type' => 'Invoice',
        'file_path' => '/files/docs/SHP-2025-0001/invoice.pdf',
        'note' => 'Proforma',
        'created' => '2025-09-11 00:00:00',
        'modified' => '2025-09-11 00:00:00',
    ]];
}
