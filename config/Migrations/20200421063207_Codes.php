<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Codes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('codes');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('code', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('result', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
