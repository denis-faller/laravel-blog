<?php

namespace Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Blog\Services\SiteService;
use Blog\Repositories\SiteRepository;
use Blog\Models\Site;
use Blog\Services\HeaderMenuService;
use Blog\Repositories\HeaderMenuRepository;
use Blog\Models\HeaderMenu;
use Blog\Services\FooterMenuService;
use Blog\Repositories\FooterMenuRepository;
use Blog\Models\FooterMenu;
use Blog\Services\SocialLinksService;
use Blog\Repositories\SocialLinksRepository;
use Blog\Models\SocialLinks;
use Blog\Services\PostService;
use Blog\Repositories\PostRepository;
use Blog\Models\Post;
use Blog\Services\AboutPageService;
use Blog\Repositories\AboutPageRepository;
use Blog\Models\AboutPage;
use Blog\Services\StaffService;
use Blog\Repositories\StaffRepository;
use Blog\Models\Staff;
use Blog\Services\ContactPageService;
use Blog\Repositories\ContactPageRepository;
use Blog\Models\ContactPage;
use Blog\Services\CategoryService;
use Blog\Repositories\CategoryRepository;
use Blog\Models\Category;
use Blog\Services\TagService;
use Blog\Repositories\TagRepository;
use Blog\Models\Tag;
use Blog\Services\CommentService;
use Blog\Repositories\CommentRepository;
use Blog\Models\Comment;
use Blog\Services\SubscriberService;
use Blog\Repositories\SubscriberRepository;
use Blog\Models\Subscriber;
use Blog\Services\UserService;
use Blog\Repositories\UserRepository;
use Blog\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     * Регистрирует привязки для сервисов
     * Задает переменную site, header_menu, footer_menu, social_links для всех представлений сайта
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(SiteService::class, function () {
            return new SiteService(new SiteRepository(new Site()));
        });
        
        $this->app->singleton(HeaderMenuService::class, function () {
            return new HeaderMenuService(new HeaderMenuRepository(new HeaderMenu()));
        });
        
        $this->app->singleton(FooterMenuService::class, function () {
            return new FooterMenuService(new FooterMenuRepository(new FooterMenu()));
        });
        
        $this->app->singleton(SocialLinksService::class, function () {
            return new SocialLinksService(new SocialLinksRepository(new SocialLinks()));
        });
        
        $this->app->singleton(PostService::class, function () {
            return new PostService(new PostRepository(new Post()));
        });
        
        $this->app->singleton(AboutPageService::class, function () {
            return new AboutPageService(new AboutPageRepository(new AboutPage()));
        });
        
       $this->app->singleton(StaffService::class, function () {
            return new StaffService(new StaffRepository(new Staff()));
        });
        
        $this->app->singleton(ContactPageService::class, function () {
            return new ContactPageService(new ContactPageRepository(new ContactPage()));
        });
        
        $this->app->singleton(CategoryService::class, function () {
            return new CategoryService(new CategoryRepository(new Category()));
        });
        
        $this->app->singleton(TagService::class, function () {
            return new TagService(new TagRepository(new Tag()));
        });
        
        $this->app->singleton(TagService::class, function () {
            return new TagService(new TagRepository(new Tag()));
        });
        
        $this->app->singleton(CommentService::class, function () {
            return new CommentService(new CommentRepository(new Comment()));
        });
        
        $this->app->singleton(SubscriberService::class, function () {
            return new SubscriberService(new SubscriberRepository(new Subscriber()));
        });
        
        $this->app->singleton(UserService::class, function () {
            return new UserService(new UserRepository(new User()));
        });
        
        $serviceSite = app(SiteService::class);
        $site = $serviceSite->find(Site::MAIN_SITE_ID);
        
        $serviceHeaderMenu = app(HeaderMenuService::class);
        $headerMenu = $serviceHeaderMenu->all();
        
        $serviceFooterMenu = app(FooterMenuService::class);
        $footerMenu = $serviceFooterMenu->all();
        
        $serviceSocialLinks = app(SocialLinksService::class);
        $socialLinks = $serviceSocialLinks->all();

        view()->share(['site' => $site, 'headerMenu' => $headerMenu, 'footerMenu' => $footerMenu, 'socialLinks' => $socialLinks]);
    }
}
