<?php
declare(strict_types=1);

namespace Shipments\Model\Table;

use Cake\ORM\Table;

class ShipmentDocumentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('shipment_documents');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Shipments', [
            'className' => 'Shipments.Shipments',
            'foreignKey' => 'shipment_id',
        ]);
    }
}
