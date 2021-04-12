<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30)->unique();
            $table->string('descripcion', 30)->unique();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        //Insertar el rol por defecto de administrador
        DB::table('roles')->insert(array('id' => '1', 'nombre' => 'Administrador', 'descripcion' => 'Administradores de área'));
        DB::table('roles')->insert(array('id' => '2', 'nombre' => 'Vendedor', 'descripcion' => 'Vendedor área venta'));
        DB::table('roles')->insert(array('id' => '3', 'nombre' => 'Bodeguero', 'descripcion' => 'Bodeguero área compras'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
