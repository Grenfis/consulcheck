<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users', ['id' => 'user_id']);
        $table->addColumn('user_name', 'string', ['limit' => 30, 'null' => false])
            ->addColumn('user_firstname', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('user_lastname', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('user_is_admin', 'boolean', ['null' => false])
            ->addColumn('user_is_active', 'boolean', ['null' => false])
            ->addColumn('user_created_at', 'timestamp', ['null' => false])
            ->create();
    }
}
