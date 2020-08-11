<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('about_page_id');
            $table->foreign('about_page_id')->references('id')->on('about_page');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('img', 255);
            $table->string('facebook', 255);
            $table->string('instagram', 255);
            $table->string('twitter', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('staff')->insert([
            ['about_page_id' => 1, 'name' => 'Kate Hampton', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum neque nobis eos quam necessitatibus rerum aliquid est tempore, cupiditate iure at voluptatum dolore, voluptates. Debitis accusamus, beatae ipsam excepturi mollitia.', 'img' => '/assets/images/person_1.jpg', 'facebook' => 'https://www.facebook.com/', 'instagram' => 'https://www.instagram.com/', 'twitter' => 'https://twitter.com/', 'created_at' => $date, 'updated_at' => $date],
            ['about_page_id' => 1, 'name' => 'Richard Cook', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum neque nobis eos quam necessitatibus rerum aliquid est tempore, cupiditate iure at voluptatum dolore, voluptates. Debitis accusamus, beatae ipsam excepturi mollitia.', 'img' => '/assets/images/person_2.jpg', 'facebook' => 'https://www.facebook.com/', 'instagram' => 'https://www.instagram.com/', 'twitter' => 'https://twitter.com/', 'created_at' => $date, 'updated_at' => $date],
            ['about_page_id' => 1, 'name' => 'Kevin Peters', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum neque nobis eos quam necessitatibus rerum aliquid est tempore, cupiditate iure at voluptatum dolore, voluptates. Debitis accusamus, beatae ipsam excepturi mollitia.', 'img' => '/assets/images/person_3.jpg', 'facebook' => 'https://www.facebook.com/', 'instagram' => 'https://www.instagram.com/', 'twitter' => 'https://twitter.com/', 'created_at' => $date, 'updated_at' => $date]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
