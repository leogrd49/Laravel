<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('motifs', function (Blueprint $table) {
            $table->dropColumn('is_accessible_salarie');
            $table->boolean('is-accessible-salarie')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motifs', function (Blueprint $table) {
            $table->dropColumn('is-accessible-salarie');
            $table->boolean('is_accessible_salarie')->default(false);
        });
    }
};
