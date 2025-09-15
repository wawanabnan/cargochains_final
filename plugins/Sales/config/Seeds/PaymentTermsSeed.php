<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class PaymentTermsSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->table('payment_terms')->truncate();

        $now = date('Y-m-d H:i:s');
        $rows = [
            ['code'=>'COD',   'name'=>'Cash On Delivery', 'days'=>0,  'description'=>null, 'created'=>$now, 'modified'=>$now],
            ['code'=>'NET30', 'name'=>'Net 30 Days',      'days'=>30, 'description'=>null, 'created'=>$now, 'modified'=>$now],
            ['code'=>'NET45', 'name'=>'Net 45 Days',      'days'=>45, 'description'=>null, 'created'=>$now, 'modified'=>$now],
            ['code'=>'NET60', 'name'=>'Net 60 Days',      'days'=>60, 'description'=>null, 'created'=>$now, 'modified'=>$now],
        ];

        $this->table('payment_terms')->insert($rows)->save();
    }
}
