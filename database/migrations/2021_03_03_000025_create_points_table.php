<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('badge_category_id');
            $table->string('name');
            $table->string('description');
            $table->string('method');
            $table->unsignedBigInteger('quantity');

            $table->datetime('created_at')->useCurrent();
			$table->datetime('updated_at')->nullable();

            $table->foreign('badge_category_id')
                ->references('id')->on('badge_categories')
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
        Schema::dropIfExists('points');
    }
}
