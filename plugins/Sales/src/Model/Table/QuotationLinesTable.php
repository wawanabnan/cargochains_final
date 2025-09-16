<?php
declare(strict_types=1);
namespace Sales\Model\Table;
use Cake\ORM\Table;
class QuotationLinesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('sales_quotation_lines');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
		
		$this->belongsTo('Origin', [
		  'className'  => 'Geo.Locations',
		  'foreignKey' => 'origin_id',
		  'joinType'   => 'LEFT',
		]);
		$this->belongsTo('Destination', [
		  'className'  => 'Geo.Locations',
		  'foreignKey' => 'destination_id',
		  'joinType'   => 'LEFT',
		]);
    }
}
