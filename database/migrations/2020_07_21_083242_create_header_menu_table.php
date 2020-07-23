<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('name', 255);
            $table->string('href', 255);
            $table->integer('sort');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('header_menu')->insert(
            ['site_id' => 1, 'name' => 'Главная', 'href' => '/', 'sort' => 100, 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => 1, 'name' => 'Политика', 'href' => '/politics/', 'sort' => 200, 'created_at' => $date, 'updated_at' => $date],  
            ['site_id' => 1, 'name' => 'Технологии', 'href' => '/tech/', 'sort' => 300, 'created_at' => $date, 'updated_at' => $date]
        );
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
