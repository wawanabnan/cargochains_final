<?php
declare(strict_types=1);

namespace Shipments\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ShipmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('shipments');
        $this->setPrimaryKey('id');
        $this->setDisplayField('number');
        $this->addBehavior('Timestamp');

        // === Associations ke Partners ===
        $this->belongsTo('Shipper', [
            'className' => 'Partners.Partners',
            'foreignKey' => 'shipper_id',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Consignee', [
            'className' => 'Partners.Partners',
            'foreignKey' => 'consignee_id',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Carrier', [
            'className' => 'Partners.Partners',
            'foreignKey' => 'carrier_id',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Agency', [
            'className' => 'Partners.Partners',
            'foreignKey' => 'agency_id',
            'joinType' => 'LEFT',
        ]);

        // Route & Documents yang sudah ada
        $this->hasMany('ShipmentRoutes', [
            'className' => 'Shipments.ShipmentRoutes',
            'foreignKey' => 'shipment_id',
            'dependent' => true,
        ]);

        $this->hasMany('ShipmentDocuments', [
            'className' => 'Shipments.ShipmentDocuments',
            'foreignKey' => 'shipment_id',
            'dependent' => true,
        ]);
    }

    public function validationDefault(Validator $v): Validator
    {
        $v->scalar('number')->maxLength('number', 30)->notEmptyString('number');
        $v->scalar('status')->maxLength('status', 20)->notEmptyString('status');
        return $v;
    }
}
