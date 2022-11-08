<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipment_classification_id')->nullable();
            $table->string('name');
            $table->string('alias')->nullable();

            $table->enum('operational_status',
                [
                    'Disposed/Destroyed',
                    'Mothballed',
                    'Normal Operation',
                    'Pending Repair All Gas Removed',
                    'Planned Retirement',
                    'Planned Retrofit',
                    'Interim Non-Operation',
                    'Seasonal Non-Operation',
                    'Seasonal Operation',
                    'Shutdown',
                    'Sold',
                    'Under Repair',
                ]
            )->nullable();

            $table->enum('regulatory_class',
                [
                    'Comfort Cooling',
                    'Industrial Process Cooling',
                    'Other',
                    'Refrigeration',
                ]
            );

            $table->enum('oil_type',
                [
                    'AB',
                    'POE',
                    'Mineral'
                ]
            )->nullable();

            $table->string('classification_other')->nullable();
            $table->string('model');
            $table->string('model_year');
            $table->string('serial');
            $table->string('manufacturer')->nullable();
            $table->date('manufactured_at')->nullable();
            $table->boolean('is_ocr_scanned')->default(false);
            $table->date('acquired_at')->nullable();
            $table->string('room_area')->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->text('notes')->nullable();
            $table->date('shutdown_at')->nullable();
            $table->datetime('created_at')->useCurrent();
			$table->datetime('updated_at')->nullable();

            $table->foreign('equipment_classification_id')
                ->references('id')->on('equipment_asset_classifications')
                ->onDelete('set null')
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
        Schema::dropIfExists('equipment_assets');
    }
}
