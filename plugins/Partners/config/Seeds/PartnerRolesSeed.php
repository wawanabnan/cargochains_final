<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class PartnerRolesSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->table('partner_roles')->truncate();

        $now = date('Y-m-d H:i:s');
        $partners = $this->fetchAll('SELECT id, name FROM partners ORDER BY id ASC');

        // rencana jumlah per role
        $plan = [
            'customer' => 10,
            'vendor'   => 5,
            'reseller' => 1,
            'agency'   => 2,
            'carrier'  => 5,
        ];

        $rows = [];
        $idx = 0;

        foreach ($plan as $role => $count) {
            for ($i = 0; $i < $count; $i++, $idx++) {
                if (!isset($partners[$idx])) {
                    throw new RuntimeException("Jumlah partners kurang untuk role {$role}");
                }
                $rows[] = [
                    'partner_id' => (int)$partners[$idx]['id'],
                    'role'       => $role, // pastikan kolom ini ada di tabel partner_roles
                    'created'    => $now,
                    'modified'   => $now,
                ];
            }
        }

        if ($rows) {
            $this->table('partner_roles')->insert($rows)->save();
        }
    }
}
