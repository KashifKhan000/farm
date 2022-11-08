<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePartsRequiredFromServiceEventLeakInspectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_event_leak_inspections', function (Blueprint $table) {
            $table->dropColumn('parts_required');
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
            $table->string('parts_required')->after('equipment_asset_id');
        });
    }
}
