<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->string('name', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        $date = Carbon\Carbon::now();
        DB::table('roles')->insert(
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Администратор','created_at' => $date, 'updated_at' => $date]
        );
        DB::table('roles')->insert(
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Зарегистрированный пользователь','created_at' => $date, 'updated_at' => $date]
        );
        DB::table('roles')->insert(
            ['site_id' => Site::MAIN_SITE_ID, 'name' => 'Контент-менеджер','created_at' => $date, 'updated_at' => $date]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
