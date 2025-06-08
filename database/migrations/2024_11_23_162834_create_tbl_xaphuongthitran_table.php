<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblXaphuongthitranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_xaphuongthitran', function (Blueprint $table) {
            $table->string('xaid', 5)->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('name', 100)->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('type', 30)->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('maqh', 5)->charset('utf8')->collation('utf8_unicode_ci');
            
            $table->primary('xaid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_xaphuongthitran');
    }
}
