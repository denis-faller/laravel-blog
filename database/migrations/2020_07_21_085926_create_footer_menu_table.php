<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('name', 255);
            $table->string('href', 255);
            $table->integer('sort');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('footer_menu')->insert(
            ['site_id' => 1, 'name' => 'Главная', 'href' => '/', 'sort' => 100, 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => 1, 'name' => 'О компании', 'href' => '/about/', 'sort' => 200, 'created_at' => $date, 'updated_at' => $date],  
            ['site_id' => 1, 'name' => 'Контакты', 'href' => '/contacts/', 'sort' => 300, 'created_at' => $date, 'updated_at' => $date]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_menu');
    }
}
