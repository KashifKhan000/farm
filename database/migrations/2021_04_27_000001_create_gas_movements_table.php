<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasMovementsTable extends Migration
{
    /**Whia
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_movements', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('gas_transfer_id')->nullable();
            $table->unsignedBigInteger('to_cylinder_asset_id')->nullable();
            $table->unsignedBigInteger('from_cylinder_asset_id')->nullable();
            $table->unsignedBigInteger('from_equipment_asset_circuit_id')->nullable();
            $table->unsignedBigInteger('to_equipment_asset_circuit_id')->nullable();
            $table->unsignedBigInteger('gas_quantity')->nullable();
            $table->bigInteger('vacuum_pulled')->nullable();
            $table->string('vacuum_pulled_unit')->nullable();
            $table->text('notes')->nullable();

            $table->datetime('created_at')->useCurrent();
			$table->datetime('updated_at')->nullable();

            $table->foreign('gas_transfer_id')
                ->references('id')->on('gas_transfers')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('from_equipment_asset_circuit_id')
                ->references('id')->on('equipment_asset_circuits')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('to_equipment_asset_circuit_id')
                ->references('id')->on('equipment_asset_circuits')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('from_cylinder_asset_id')
                ->references('id')->on('cylinder_assets')
                ->onDelete('cascade')
                ->onUpdate('restrict');


            $table->foreign('to_cylinder_asset_id')
                ->references('id')->on('cylinder_assets')
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
        Schema::dropIfExists('gas_movements');
    }
}
