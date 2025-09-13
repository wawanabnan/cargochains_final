<?php
declare(strict_types=1);

namespace Shipments\Model\Table;

use Cake\ORM\Table;

class TransportationTypesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('transportation_types');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }
}
