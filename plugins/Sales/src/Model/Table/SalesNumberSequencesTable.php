<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Table;

class SalesNumberSequencesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('sales_number_sequences');
        $this->setPrimaryKey('id');
    }
}
