<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceEventRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_event_repairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_event_id');
            $table->unsignedBigInteger('equipment_asset_id');
            $table->enum('type', ['Service', 'Leak Repair']);
            $table->string('parts_required');
            $table->enum('actions',
                [
                    'Bypass',
                    'Calibrate/Adjust',
                    'New Cap/Seal',
                    'Relocate',
                    'Remove',
                    'Repair',
                    'Replace',
                    'Tighten',
                    'Weld',
                    'Other',
                ]
            )->nullable();

            $table->string('actions_other')->nullable();

            $table->enum('verification_method',
                [
                    'ALDS',
                    'Alternative',
                    'Bubble',
                    'Dye',
                    'Electronic',
                    'Evacuation',
                    'Halide',
                    'Pressure',
                ]
            );

            $table->string('notes')->nullable();
            $table->string('verification_method_alternative')->nullable();
            $table->datetime('created_at')->useCurrent();
			$table->datetime('updated_at')->nullable();

            $table->foreign('service_event_id')
                ->references('id')->on('service_events')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('equipment_asset_id')
                ->references('id')->on('equipment_assets')
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
        Schema::dropIfExists('service_event_repairs');
    }
}
