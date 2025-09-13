<?php

use Migrations\AbstractMigration;

class CreateShipmentDocuments extends AbstractMigration
{
    public function change(): void
    {
        $fk = ['delete' => 'CASCADE', 'update' => 'NO_ACTION', 'constraint' => 'fk_documents_shipment'];

        $this->table('shipment_documents')
            ->addColumn('shipment_id', 'integer', ['null' => false])
            ->addColumn('doc_type', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('file_path', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('note', 'text', ['null' => true, 'default' => null])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->addForeignKey('shipment_id', 'shipments', 'id', $fk)
            ->create();
    }
}
