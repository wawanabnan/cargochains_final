<?php
declare(strict_types=1);

namespace Sales\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesService Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property string $name
 * @property string|null $transport_mode
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \Sales\Model\Entity\ParentSalesService $parent_sales_service
 * @property \Sales\Model\Entity\SalesOrder[] $sales_orders
 * @property \Sales\Model\Entity\SalesQuotation[] $sales_quotations
 * @property \Sales\Model\Entity\ChildSalesService[] $child_sales_services
 */
class SalesService extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'name' => true,
        'transport_mode' => true,
        'created' => true,
        'modified' => true,
        'parent_sales_service' => true,
        'sales_orders' => true,
        'sales_quotations' => true,
        'child_sales_services' => true,
    ];
}
