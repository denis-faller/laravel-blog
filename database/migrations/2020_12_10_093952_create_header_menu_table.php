<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateHeaderMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->integer('sort');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('header_menu')->insert([
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Главная', 'url' => '', 'sort' => 100, 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Политика', 'url' => 'politics', 'sort' => 200, 'created_at' => $date, 'updated_at' => $date],  
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Технологии', 'url' => 'tech', 'sort' => 300, 'created_at' => $date, 'updated_at' => $date]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_menu');
    }
}
