<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Tableproductos extends AbstractMigration
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
    public function change(): void
    {
        $table = $this->table('productos');
        $table->addColumn('nombre_producto', 'string',['null'=>false])
            ->addColumn('referencia', 'string',['null'=>false])
            ->addColumn('precio', 'integer',['null'=>false])
            ->addColumn('peso', 'integer',['null'=>false])

            ->addColumn('id_categoria', 'integer',['null'=>true])
            ->addForeignKey('id_categoria', 'categoria', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])

            ->addColumn('stock', 'integer',['null'=>false])
            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
