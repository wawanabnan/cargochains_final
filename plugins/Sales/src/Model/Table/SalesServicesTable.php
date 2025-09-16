<?php
declare(strict_types=1);

namespace Sales\Model\Table;

use Cake\ORM\Table;

class SalesServicesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Nama tabel
        $this->setTable('sales_services');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');

        // Tree behaviour → otomatis gunakan parent_id, lft, rght
        $this->addBehavior('Tree');

        /**
         * 🔗 Self Association
         * ParentService: relasi ke induk (misal "Sea Freight")
         * ChildServices: relasi ke anak (misal "Door to Door")
         */
        $this->belongsTo('ParentServices', [
            'className'  => 'Sales.SalesServices',
            'foreignKey' => 'parent_id',
            'joinType'   => 'LEFT',
        ]);

        $this->hasMany('ChildServices', [
            'className'  => 'Sales.SalesServices',
            'foreignKey' => 'parent_id',
        ]);

        /**
         * 🔗 Relasi ke Quotation
         * supaya bisa contain SalesServices dari Quotation
         */
        $this->hasMany('Quotations', [
            'className'  => 'Sales.Quotations',
            'foreignKey' => 'sales_service_id',
        ]);
    }
}
