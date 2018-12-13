<?php


use Phinx\Migration\AbstractMigration;

class NewsMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $news = $this->table('news');
        $news->addColumn('title', 'string', ['limit' => 100])
              ->addColumn('body', 'string', ['limit' => 255])
              ->addColumn('owner', 'integer')
              ->addForeignKey('owner', 'users', 'id', ['update'=> 'NO_ACTION'])
              ->addColumn('views', 'integer')
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime', ['null' => true])
              ->addColumn('deleted', 'datetime', ['null' => true])
              ->create();
    }
}
