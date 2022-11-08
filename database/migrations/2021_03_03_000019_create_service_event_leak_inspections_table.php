<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceEventLeakInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_event_leak_inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_event_id');
            $table->unsignedBigInteger('equipment_asset_id');
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
            $table->enum('detection_method',
                [
                    'Alternative',
                    'Bubble',
                    'Dye',
                    'Electronic Ultrasonic',
                    'Evacuate',
                    'Pressure Test',
                    'Halide'
                ]
            )->nullable();

            $table->string('detection_method_other')->nullable();
            $table->boolean('alds_used');
            $table->enum('alds_type',
                [
                    'Direct',
                    'Indirect',
                ]
            )->nullable();

            $table->string('alds_model')->nullable();
            $table->datetime('inspection_at');
            $table->boolean('leak_found');
            $table->enum('leak_cause',
                [
                    'Rub Out',
                    'Joint Failure',
                    'Corrosion',
                    'Vibration',
                    'Abuse',
                    'Warranty',
                    'Seal Failure',
                    'Rupture',
                    'Catastrophe',
                    'Mechanical Failure',
                    'ALDS',
                ]
            )->nullable();

            $table->enum('leak_corrective_action',
                [
                    'Notify Engineering',
                    'Scheduled Repair',
                    'Removed From Service',
                    'Planned Retrofit',
                    'Waiting On Parts',
                ]
            )->nullable();

            $table->string('notes')->nullable();

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
        Schema::dropIfExists('service_event_leak_inspections');
    }
}
