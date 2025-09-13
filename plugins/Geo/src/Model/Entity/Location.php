<?php
declare(strict_types=1);

namespace Geo\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $kind
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $iata_code
 * @property string $unlocode
 * @property string $latitude
 * @property string $longitude
 *
 * @property \Geo\Model\Entity\ParentLocation $parent_location
 * @property \Geo\Model\Entity\ChildLocation[] $child_locations
 */
class Location extends Entity
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
        'code' => true,
        'name' => true,
        'kind' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'iata_code' => true,
        'unlocode' => true,
        'latitude' => true,
        'longitude' => true,
        'parent_location' => true,
        'child_locations' => true,
    ];
	
	 public const KINDS = [
        'country',
        'province',
        'city',
        'port',
        'airport',
    ];
	
}
