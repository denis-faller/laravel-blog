<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateFooterMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_menus', function (Blueprint $table) {
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
        DB::table('footer_menus')->insert([
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Главная', 'url' => '', 'sort' => 100, 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'О компании', 'url' => 'about', 'sort' => 200, 'created_at' => $date, 'updated_at' => $date],  
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Контакты', 'url' => 'contacts', 'sort' => 300, 'created_at' => $date, 'updated_at' => $date]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_menus');
    }
}