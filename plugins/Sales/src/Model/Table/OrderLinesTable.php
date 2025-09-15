<?php
declare(strict_types=1);
namespace Sales\Model\Table;
use Cake\ORM\Table;
class SalesOrderLinesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('sales_order_lines');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
    }
}
