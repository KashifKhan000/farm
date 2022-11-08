<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCylinderAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cylinder_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('cylinder_size');
            $table->string('serial_number');
            $table->string('tag_number');
            $table->enum('type',
                [
                    'Disposable',
                    'Refillable',
                    'Recovery'
                ]
            );
            $table->string('purity_label');
            $table->string('manufacturer')->nullable();
            $table->date('manufactured_at');
            $table->date('last_recertification_at')->nullable();
            $table->date('next_recertification_at')->nullable();
            $table->decimal('tare_weight', $precision = 8, $scale = 2);
            $table->unsignedBigInteger('current_gas_weight');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->nullable();

            $table->index('serial_number');
            $table->index('tag_number');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('cylinder_assets');
    }
}
