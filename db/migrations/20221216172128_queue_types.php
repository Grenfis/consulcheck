<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class QueueTypes extends AbstractMigration
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
    private const TABLE_NAME = 'queues';
    private const COLUMN_ID = 'queue_id';
    private const COLUMN_NAME = 'queue_name';

    public function change()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => self::COLUMN_ID]);
        $table->addColumn(self::COLUMN_NAME, 'string', ['null' => false])
            ->create();
        if ($this->isMigratingUp()) {
            $table
                ->insert([
                    [
                        self::COLUMN_ID => 1,
                        self::COLUMN_NAME => 'Ереван 5 лет',
                    ],
                    [
                        self::COLUMN_ID => 2,
                        self::COLUMN_NAME => 'Гюмри 5 лет',
                    ],
                    [
                        self::COLUMN_ID => 3,
                        self::COLUMN_NAME => 'Гюмри 10 лет',
                    ],
                ])->save();
        }
    }
}
