<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->text('title_text');
            $table->string('title_img', 255);
            $table->text('after_title_text');
            $table->string('after_title_img', 255);
            $table->text('team_title_text');
            $table->text('after_team_text');
            $table->string('after_team_img', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_page');
    }
}
