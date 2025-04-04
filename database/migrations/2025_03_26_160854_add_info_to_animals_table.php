<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('animals', function (Blueprint $table) {
        $table->text('info')->nullable(); // Add the 'info' field
    });
}

public function down()
{
    Schema::table('animals', function (Blueprint $table) {
        $table->dropColumn('info');
    });
}

};
