<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateContactPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->text('title_text');
            $table->string('title_img', 255);
            $table->string('address', 255);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('contact_page')->insert(
            [   'site_id' => Site::MAIN_SITE_ID, 
                'title_text' => '<h1 class="">Contact Us</h1>
              <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>', 
                'title_img' => '/assets/images/img_4.jpg',
                'address' => '203 Fake St. Mountain View, San Francisco, California, USA',
                'phone' => '+1 232 3235 324',
                'email' => 'youremail@domain.com',
                'created_at' => $date, 
                'updated_at' => $date]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_page');
    }
}
