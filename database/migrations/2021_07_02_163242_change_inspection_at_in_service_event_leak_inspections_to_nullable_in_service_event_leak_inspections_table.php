<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInspectionAtInServiceEventLeakInspectionsToNullableInServiceEventLeakInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_event_leak_inspections', function (Blueprint $table) {
            $table->datetime('inspection_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_event_leak_inspections', function (Blueprint $table) {
            $table->datetime('inspection_at')->change();
        });
    }
}
