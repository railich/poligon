<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('category_id')->unsigned()->comment('Категория поста');
            $table->bigInteger('user_id')->unsigned()->comment('автор статьи');

            $table->string('slug')->unique()->comment('уникальный title в транслите для url');
            $table->string('title')->comment('Заголовок статьи');

            $table->text('excerpt')->nullable()->comment('Выдержка из статьи');

            $table->text('content_raw')->comment('Статья в формате markdown');
            $table->text('content_html')->comment('Статья в формате html, создается автоматом из raw');

            $table->boolean('is_published')
                ->default(false)
                ->index()
                ->comment('Опубликовано = 1 или нет = 0');

            $table->timestamp('published_at')->nullable()->comment('Дата опубликования');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('blog_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
