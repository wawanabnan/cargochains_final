<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class PartnersSeed extends AbstractSeed
{
    public function run(): void
    {
        // urutan truncate: roles dulu → partners (hindari FK error)
        $this->table('partner_roles')->truncate();
        $this->table('partners')->truncate();

        $now = date('Y-m-d H:i:s');
        $rows = [];

        // total 23 partner sesuai permintaan (nama saja, TANPA kolom role)
        for ($i=1; $i<=10; $i++) $rows[] = ['name'=>"Customer $i", 'created'=>$now, 'modified'=>$now];
        for ($i=1; $i<=5;  $i++) $rows[] = ['name'=>"Vendor $i",   'created'=>$now, 'modified'=>$now];
        $rows[] = ['name'=>"Reseller 1", 'created'=>$now, 'modified'=>$now];
        for ($i=1; $i<=2;  $i++) $rows[] = ['name'=>"Agency $i",  'created'=>$now, 'modified'=>$now];
        for ($i=1; $i<=5;  $i++) $rows[] = ['name'=>"Carrier $i", 'created'=>$now, 'modified'=>$now];

        $this->table('partners')->insert($rows)->save();
    }
}
