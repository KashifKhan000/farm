<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetGasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_gas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('owner');
            $table->unsignedBigInteger('gas_id')->nullable();
            $table->unsignedBigInteger('purity')->default(100);
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->foreign('gas_id')
                ->references('id')->on('gases')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_gas');
    }
}
