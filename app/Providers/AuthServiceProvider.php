<?php

namespace Blog\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Blog\Models\User::class => \Blog\Policies\UserPolicy::class,
        \Blog\Models\Tag::class => \Blog\Policies\TagPolicy::class,
        \Blog\Models\Category::class => \Blog\Policies\CategoryPolicy::class,
        \Blog\Models\Post::class => \Blog\Policies\PostPolicy::class,
        \Blog\Models\Comment::class => \Blog\Policies\CommentPolicy::class,
        \Blog\Models\HeaderMenu::class => \Blog\Policies\HeaderMenuPolicy::class,
        \Blog\Models\FooterMenu::class => \Blog\Policies\FooterMenuPolicy::class,
        \Blog\Models\SocialLink::class => \Blog\Policies\SocialLinkPolicy::class,
        \Blog\Models\AboutPage::class => \Blog\Policies\AboutPagePolicy::class,
        \Blog\Models\Staff::class => \Blog\Policies\StaffPolicy::class,
        \Blog\Models\ContactPage::class => \Blog\Policies\ContactPagePolicy::class,
        \Blog\Models\Subscriber::class => \Blog\Policies\SubscriberPolicy::class,
        \Blog\Models\Mailing::class => \Blog\Policies\MailingPolicy::class,
        \Blog\Models\Site::class => \Blog\Policies\SitePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $view->with('currentUser', Auth::user());
            }else {
                $view->with('currentUser', null);
            }
        });
    }
}
