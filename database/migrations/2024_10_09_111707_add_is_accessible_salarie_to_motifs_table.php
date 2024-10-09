<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAccessibleSalarieToMotifsTable extends Migration
{
    public function up()
    {
        Schema::table('motifs', function (Blueprint $table) {
            $table->boolean('is_accessible_salarie')->default(false)->after('description');
        });
    }

    public function down()
    {
        Schema::table('motifs', function (Blueprint $table) {
            $table->dropColumn('is_accessible_salarie');
        });
    }
}
