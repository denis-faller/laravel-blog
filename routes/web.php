<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Как переименовать пространство имен - https://github.com/laravel/framework/issues/29810
// Руководство по аутентификации - https://stackoverflow.com/questions/34545641/php-artisan-makeauth-command-is-not-defined

Route::resource('/', 'HomeController', ['only' => [
    'index'
    ],
    'names' => [
        'index' => 'home.index'
    ]
]);

Route::resource('/recent-posts/', 'RecentPostsController', ['only' => [
    'index'
    ],
    'names' => [
        'index' => 'recent.posts.index'
    ]
]);

Route::resource('/about/', 'AboutPageController', ['only' => [
    'index'
    ],
    'names' => [
        'index' => 'about.index'
    ]
]);

Route::resource('/contacts/', 'ContactPageController', ['only' => [
    'index',
    ],
    'names' => [
        'index' => 'contact.index'
    ]
]);

Route::post('/send-mail/', 'ContactPageController@send')->name('contact.send');

Route::resource('admin/category', 'Admin\CategoryController', ['only' => [
    'index', 'create', 'store', 'show', 'update', 'destroy'
    ],
    'names' => [
        'index' => 'category.index',
        'create' => 'category.create',
        'store' => 'category.store',
        'show' => 'category.admin.show',
        'update' => 'category.update',
        'destroy' => 'category.destroy',
    ]
]);

Route::resource('category', 'CategoryController', ['only' => [
    'show',
    ],
    'names' => [
        'show' => 'category.show'
    ]
]);

Route::resource('admin/tags', 'Admin\TagController', ['only' => [
    'index', 'create', 'store', 'show', 'update', 'destroy'
    ],
    'names' => [
        'index' => 'tags.index',
        'create' => 'tags.create',
        'store' => 'tags.store',
        'show' => 'tags.admin.show',
        'update' => 'tags.update',
        'destroy' => 'tags.destroy',
    ]
]);

Route::resource('tags', 'TagController', ['only' => [
    'show'
    ],
    'names' => [
        'show' => 'tags.show',
    ]
]);

Route::resource('search', 'SearchController', ['only' => [
    'index'
    ],
    'names' => [
        'index' => 'search.index'
    ]
]);

Route::resource('subscriber', 'SubscriberController', ['only' => [
    'store'
    ],
    'names' => [
        'store' => 'subscriber.store'
    ]
]);

Auth::routes();

Route::resource('users', 'UserController', ['only' => [
    'index', 'update', 'show', 'destroy', 'create', 'store',
    ],
    'names' => [
        'index' => 'users.index',
        'update' => 'users.update',
        'show' => 'users.show',
        'destroy' => 'users.destroy',
        'create' => 'users.create',
        'store' => 'users.store',
    ]
]);

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('admin/posts', 'PostController', ['only' => [
    'index', 'update', 'show', 'destroy', 'create', 'store',
    ],
    'names' => [
        'index' => 'posts.index',
        'update' => 'posts.update',
        'show' => 'posts.admin.show',
        'destroy' => 'posts.destroy',
        'create' => 'posts.create',
        'store' => 'posts.store',
    ]
]);

Route::get('/{urlPost}', 'PostController@show')->name('post.show');

Route::resource('comment', 'CommentController', ['only' => [
    'store',
    ],
    'names' => [
        'store' => 'comment.store'
    ]
]);
