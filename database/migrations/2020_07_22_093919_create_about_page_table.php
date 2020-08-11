<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreateAboutPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->text('title_text');
            $table->string('title_img', 255);
            $table->text('after_title_text');
            $table->string('after_title_img', 255);
            $table->text('team_title_text');
            $table->text('after_team_text');
            $table->string('after_team_img', 255);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('about_page')->insert(
            [   'site_id' => Site::MAIN_SITE_ID, 
                'title_text' => '<h1 class="">About Us</h1>
              <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>', 
                'title_img' => '/assets/images/img_4.jpg',
                'after_title_text' => '<h2>We Love To Explore</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea voluptate odit corrupti vitae cupiditate explicabo, soluta quibusdam necessitatibus, provident reprehenderit, dolorem saepe non eligendi possimus autem repellendus nesciunt, est deleniti libero recusandae officiis. Voluptatibus quisquam voluptatum expedita recusandae architecto quibusdam.</p>
            <ul class="ul-check list-unstyled success">
              <li>Onsectetur adipisicing elit</li>
              <li>Dolorem saepe non eligendi possimus</li>
              <li>Voluptate odit corrupti vitae</li>
            </ul>',
                'after_title_img' => '/assets/images/img_1.jpg',
                'team_title_text' => ' <h2>Meet The Team</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus commodi blanditiis, soluta magnam atque laborum ex qui recusandae</p>',
               'after_team_text' => '<h2>Learn From Us</h2>
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea voluptate odit corrupti vitae cupiditate explicabo, soluta quibusdam necessitatibus, provident reprehenderit, dolorem saepe non eligendi possimus autem repellendus nesciunt, est deleniti libero recusandae officiis. Voluptatibus quisquam voluptatum expedita recusandae architecto quibusdam.</p>',
                'after_team_img' => '/assets/images/img_1.jpg',
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
        Schema::dropIfExists('about_page');
    }
}
