<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('domains', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('site_id')->unsigned();

        $table->string('url')->unique()->index();

        $table->string('default_locale');

        $table->timestamps();

        $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domains');
    }
}
