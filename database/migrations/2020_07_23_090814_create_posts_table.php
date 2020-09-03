<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Blog\Models\Site;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->boolean('main_page');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->timestamp('publish_time');
            $table->string('preview_img', 255);
            $table->string('img', 255);
            $table->integer('view_count');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->text('text');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        $date = Carbon\Carbon::now();
        DB::table('posts')->insert(
            [ 'site_id' => Site::MAIN_SITE_ID,
              'main_page' => 1,
              'name' => 'The AI magically removes moving objects from videos.',
              'url' => 'ai-removes',
              'publish_time' => $date, 
              'preview_img' => '/assets/images/img_1.jpg',
              'img' => '/assets/images/img_1.jpg',  
              'view_count' => 0,
              'category_id' => 1, 
              'author_id' => 1,
              'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium nam quas inventore, ut iure iste modi eos adipisci ad ea itaque labore earum autem nobis et numquam, minima eius. Nam eius, non unde ut aut sunt eveniet rerum repellendus porro.</p>',
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
        Schema::dropIfExists('posts');
    }
}
