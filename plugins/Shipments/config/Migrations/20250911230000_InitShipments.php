<?php

use Migrations\AbstractMigration;

class InitShipments extends AbstractMigration
{
    public function change(): void
    {
        // transportation_types
        $this->table('transportation_types')
            ->addColumn('name', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('transportation_mode', 'string', ['limit' => 10, 'null' => false])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->create();

        // shipments
        $idxOptions = ['unique' => true, 'name' => 'uniq_shipments_number'];
        $this->table('shipments')
            ->addColumn('number', 'string', ['limit' => 30, 'null' => false])
            ->addIndex(['number'], $idxOptions)
            ->addColumn('origin_id', 'integer', ['null' => false])
            ->addColumn('destination_id', 'integer', ['null' => false])
            ->addColumn('cargo_description', 'text', ['null' => true, 'default' => null])
            ->addColumn('weight', 'decimal', ['precision' => 12, 'scale' => 3, 'null' => true, 'default' => null])
            ->addColumn('volume', 'decimal', ['precision' => 12, 'scale' => 3, 'null' => true, 'default' => null])
            ->addColumn('qty', 'integer', ['null' => true, 'default' => null])
            ->addColumn('shipper_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('consignee_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('carrier_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('agency_id', 'integer', ['null' => true, 'default' => null])
            ->addColumn('etd', 'date', ['null' => true, 'default' => null])
            ->addColumn('eta', 'date', ['null' => true, 'default' => null])
            ->addColumn('atd', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('ata', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('status', 'string', ['limit' => 20, 'null' => false, 'default' => 'DRAFT'])
            ->addColumn('is_multimoda', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('origin', 'string', ['limit' => 100, 'null' => true, 'default' => null])
            ->addColumn('destination', 'string', ['limit' => 100, 'null' => true, 'default' => null])
            ->addColumn('bill_of_lading_no', 'string', ['limit' => 50, 'null' => true, 'default' => null])
            ->addColumn('total', 'decimal', ['precision' => 14, 'scale' => 2, 'null' => true, 'default' => null])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->create();

        // shipment_routes
        $fk1 = ['delete' => 'CASCADE', 'update' => 'NO_ACTION', 'constraint' => 'fk_routes_shipment'];
        $fk2 = ['delete' => 'RESTRICT', 'update' => 'NO_ACTION', 'constraint' => 'fk_routes_transport_type'];

        $this->table('shipment_routes')
            ->addColumn('shipment_id', 'integer', ['null' => false])
            ->addColumn('origin_id', 'integer', ['null' => false])
            ->addColumn('destination_id', 'integer', ['null' => false])
            ->addColumn('transportation_type_id', 'integer', ['null' => false])
            ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->addForeignKey('shipment_id', 'shipments', 'id', $fk1)
            ->addForeignKey('transportation_type_id', 'transportation_types', 'id', $fk2)
            ->create();
    }
}
