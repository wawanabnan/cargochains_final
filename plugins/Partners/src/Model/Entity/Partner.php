<?php
declare(strict_types=1);

namespace Partners\Model\Entity;

use Cake\ORM\Entity;

class Partner extends Entity
{
    protected array $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
