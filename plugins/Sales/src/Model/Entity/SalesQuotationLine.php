<?php
declare(strict_types=1);
namespace Sales\Model\Entity;
use Cake\ORM\Entity;
class SalesQuotationLine extends Entity
{
    protected array $_accessible = ['*' => true, 'id' => false];
}
