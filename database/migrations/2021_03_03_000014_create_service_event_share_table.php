<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceEventShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_event_share', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_event_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email');
            $table->enum('approval', ['Shared', 'Not Shared', 'Approved', 'Approved With Changes', 'Rejected']);
            $table->text('rejected_reason')->nullable();
            $table->datetime('created_at')->useCurrent();
			$table->datetime('updated_at')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('restrict');

            $table->foreign('service_event_id')
                ->references('id')->on('service_events')
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
        Schema::dropIfExists('service_event_share');
    }
}
