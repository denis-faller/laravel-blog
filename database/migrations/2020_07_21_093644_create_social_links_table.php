<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('name', 255);
            $table->string('href', 255);
            $table->integer('sort');
            $table->timestamps();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('social_links')->insert([
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'facebook', 'href' => 'https://www.facebook.com/', 'sort' => 100, 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'twitter', 'href' => 'https://twitter.com/', 'sort' => 200, 'created_at' => $date, 'updated_at' => $date],  
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'instagram', 'href' => 'https://www.instagram.com/', 'sort' => 300, 'created_at' => $date, 'updated_at' => $date]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_links');
    }
}
