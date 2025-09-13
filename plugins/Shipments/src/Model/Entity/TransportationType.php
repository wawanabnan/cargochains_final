<?php
declare(strict_types=1);

namespace Shipments\Model\Entity;

use Cake\ORM\Entity;

class TransportationType extends Entity
{
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
