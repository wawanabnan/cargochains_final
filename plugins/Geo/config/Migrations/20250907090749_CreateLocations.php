<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateLocations extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('locations');
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('kind', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('lft', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('rght', 'integer', [
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('iata_code', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('unlocode', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('latitude', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 10,
            'scale' => 7,
        ]);
        $table->addColumn('longitude', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 10,
            'scale' => 7,
        ]);
        $table->create();
    }
}
