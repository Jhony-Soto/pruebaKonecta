<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TableVentaProducto extends AbstractMigration
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
        $table = $this->table('venta_producto');
        $table->addColumn('id_venta', 'integer',['null'=>true])
                ->addForeignKey('id_venta', 'venta', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])

                ->addColumn('id_producto', 'integer',['null'=>true])
                ->addForeignKey('id_producto', 'productos', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])

                ->addColumn('cantidad', 'integer',['null'=>false])
                ->addColumn('precio', 'integer',['null'=>false])

            ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
