<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('event_details', function (Blueprint $table) {
            // First drop the foreign key
            $table->dropForeign(['staff_id']);
            // Then drop the column
            $table->dropColumn('staff_id');
        });
    }

    public function down()
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staff');
        });
    }
};
