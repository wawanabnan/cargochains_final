<?php
declare(strict_types=1);

namespace Shipments\Model\Entity;

use Cake\ORM\Entity;

class ShipmentDocument extends Entity
{
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
