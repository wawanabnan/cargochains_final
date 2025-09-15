<?php
declare(strict_types=1);

namespace Sales\Model\Entity;

use Cake\ORM\Entity;

/**
 * Quotation Entity
 *
 * @property int $id
 * @property string $number
 * @property int|null $customer_id
 * @property \Cake\I18n\Date|null $date
 * @property \Cake\I18n\Date|null $valid_until
 * @property string|null $sales_service_id
 * @property string|null $currency_id
 * @property int|null $payment_term_id
 * @property string|null $notes_1
 * @property string|null $notes_2
 * @property string|null $subtotal
 * @property string|null $tax_total
 * @property string|null $grand_total
 * @property string $status
 * @property int|null $sales_user_id
 * @property int|null $sales_agency_id
 * @property int|null $sales_reseller_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \Sales\Model\Entity\SalesService $sales_service
 * @property \Sales\Model\Entity\SalesQuotationLine[] $sales_quotation_lines
 * @property \Partners\Model\Entity\Partner $customer
 */
class Quotation extends Entity
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
        'valid_until' => true,
        'sales_service_id' => true,
        'currency_id' => true,
        'payment_term_id' => true,
        'notes_1' => true,
        'notes_2' => true,
        'subtotal' => true,
        'tax_total' => true,
        'grand_total' => true,
        'status' => true,
        'sales_user_id' => true,
        'sales_agency_id' => true,
        'sales_reseller_id' => true,
        'created' => true,
        'modified' => true,
        'sales_service' => true,
        'sales_quotation_lines' => true,
        'customer' => true,
    ];
}
