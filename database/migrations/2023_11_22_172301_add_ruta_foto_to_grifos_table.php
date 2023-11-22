<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRutaFotoToGrifosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grifos', function (Blueprint $table) {
            $table->string('ruta_foto')->nullable()->after('observaciones');
            // Otras columnas o modificaciones que desees agregar
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grifos', function (Blueprint $table) {
            $table->dropColumn('ruta_foto');
            // Otras acciones para revertir los cambios si es necesario
        });
    }
}
