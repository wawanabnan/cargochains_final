<?php
// plugins/Partners/src/Model/Table/PartnerRolesTable.php
namespace Partners\Model\Table;

use Cake\ORM\Table;

class PartnerRolesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('partner_roles'); // ← sesuai PRAGMA
        $this->setPrimaryKey('id');

        $this->belongsTo('Partners', [
            'className'  => 'Partners.Partners',
            'foreignKey' => 'partner_id',
        ]);
    }
}
