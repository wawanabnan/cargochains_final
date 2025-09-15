<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class ServicesSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $this->table('sales_services')->truncate();

        $rows = [
            // SEA (1..4)
            ['id'=>1,'parent_id'=>null,'lft'=>1,'rght'=>8,'name'=>'Sea','transport_mode'=>'SEA','created'=>$now,'modified'=>$now],
            ['id'=>2,'parent_id'=>1,'lft'=>2,'rght'=>3,'name'=>'Door to Door','transport_mode'=>'SEA','created'=>$now,'modified'=>$now],
            ['id'=>3,'parent_id'=>1,'lft'=>4,'rght'=>5,'name'=>'Door to Port','transport_mode'=>'SEA','created'=>$now,'modified'=>$now],
            ['id'=>4,'parent_id'=>1,'lft'=>6,'rght'=>7,'name'=>'Port to Port','transport_mode'=>'SEA','created'=>$now,'modified'=>$now],
            // AIR (5..7)
            ['id'=>5,'parent_id'=>null,'lft'=>9,'rght'=>14,'name'=>'Air','transport_mode'=>'AIR','created'=>$now,'modified'=>$now],
            ['id'=>6,'parent_id'=>5,'lft'=>10,'rght'=>11,'name'=>'Door to Door','transport_mode'=>'AIR','created'=>$now,'modified'=>$now],
            ['id'=>7,'parent_id'=>5,'lft'=>12,'rght'=>13,'name'=>'Port to Port','transport_mode'=>'AIR','created'=>$now,'modified'=>$now],
            // INLAND (8..9)
            ['id'=>8,'parent_id'=>null,'lft'=>15,'rght'=>18,'name'=>'Inland','transport_mode'=>'INLAND','created'=>$now,'modified'=>$now],
            ['id'=>9,'parent_id'=>8,'lft'=>16,'rght'=>17,'name'=>'Trucking','transport_mode'=>'INLAND','created'=>$now,'modified'=>$now],
        ];

        $this->table('sales_services')->insert($rows)->save();
    }
}
