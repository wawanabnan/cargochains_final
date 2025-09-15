<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class PartnersDemoSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->call('PartnersSeed');       // buat partners
        $this->call('PartnerRolesSeed');   // assign roles
    }
}
