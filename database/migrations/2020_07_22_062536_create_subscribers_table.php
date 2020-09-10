<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('email', 255);
            $table->unique('email');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('subscribers')->insert([
            ['site_id' => Site::MAIN_SITE_ID, 'email' => 'richsiteru@gmail.com', 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => Site::MAIN_SITE_ID, 'email' => 'greatconvert@yandex.ru', 'created_at' => $date, 'updated_at' => $date]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}
