<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreign('site_id')->references('id')->on('sites');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('subscribers')->insert(
            ['site_id' => 1, 'name' => 'Jhon', 'email' => 'richsiteru@gmail.com', 'created_at' => $date, 'updated_at' => $date],
            ['site_id' => 1, 'name' => 'Michael', 'email' => 'richsiteru@gmail.com', 'created_at' => $date, 'updated_at' => $date]
        );
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
