<?php
// plugins/Partners/src/Model/Table/CustomersTable.php
namespace Partners\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query\SelectQuery;

class CustomersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('partners');
        $this->setPrimaryKey('id');
        $this->setDisplayField('name');

        $this->hasMany('PartnerRoles', [
            'className'  => 'Partners.PartnerRoles',
            'foreignKey' => 'partner_id',
        ]);
    }

    // Hanya partner yg punya role 'customer'
    public function findAsCustomers(SelectQuery $query, array $options = []): SelectQuery
    {
        $roleField = $options['roleField'] ?? 'role';       // ← kolom di partner_roles
        $roleValue = $options['roleValue'] ?? 'customer';   // ← nilai default

        $query
            ->matching('PartnerRoles', function (SelectQuery $q) use ($roleField, $roleValue) {
                return $q->where(["PartnerRoles.$roleField" => $roleValue]);
            })
            ->distinct($this->aliasField('id'));

        return $query;
    }
}
