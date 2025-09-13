<?php
declare(strict_types=1);

namespace Sales\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesQuotation Entity
 *
 * @property int $id
 * @property string $number
 * @property int|null $customer_id
 * @property \Cake\I18n\Date|null $date
 * @property string|null $currency
 * @property string|null $notes
 * @property string|null $subtotal
 * @property string|null $tax_total
 * @property string|null $grand_total
 * @property string $status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \Sales\Model\Entity\SalesQuotationLine[] $sales_quotation_lines
 */
class SalesQuotation extends Entity
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
        'number' => true,
        'customer_id' => true,
        'date' => true,
        'currency' => true,
        'notes' => true,
        'subtotal' => true,
        'tax_total' => true,
        'grand_total' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'sales_quotation_lines' => true,
    ];
}
