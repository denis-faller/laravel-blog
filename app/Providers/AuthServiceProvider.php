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
