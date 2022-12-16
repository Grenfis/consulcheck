<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersQueue extends AbstractMigration
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
        $table = $this->table('users_queue', ['id' => false]);
        $table->addColumn('user_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('queue_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('created_at', 'timestamp', ['null' => false])
            ->addForeignKey('user_id', 'users', 'user_id', ['delete' => 'CASCADE'])
            ->addForeignKey('queue_id', 'queues', 'queue_id', ['delete' => 'CASCADE'])
            ->create();
    }
}
