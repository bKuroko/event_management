<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsApprovedToEventDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false)->after('category'); // Add after any existing column
        });
    }

    public function down()
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
}
