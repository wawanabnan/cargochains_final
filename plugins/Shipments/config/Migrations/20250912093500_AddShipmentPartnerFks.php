<?php

use Migrations\AbstractMigration;

class AddShipmentPartnerFks extends AbstractMigration
{
    public function change(): void
    {
        if (!$this->hasTable('shipments')) {
            return;
        }
        $this->table('shipments')
            ->addForeignKey('shipper_id', 'partners', 'id', [
                'delete' => 'SET_NULL', 'update' => 'NO_ACTION', 'constraint' => 'fk_shipments_shipper'
            ])
            ->addForeignKey('consignee_id', 'partners', 'id', [
                'delete' => 'SET_NULL', 'update' => 'NO_ACTION', 'constraint' => 'fk_shipments_cons'
            ])
            ->addForeignKey('carrier_id', 'partners', 'id', [
                'delete' => 'SET_NULL', 'update' => 'NO_ACTION', 'constraint' => 'fk_shipments_carrier'
            ])
            ->addForeignKey('agency_id', 'partners', 'id', [
                'delete' => 'SET_NULL', 'update' => 'NO_ACTION', 'constraint' => 'fk_shipments_agency'
            ])
            ->update();
    }
}
