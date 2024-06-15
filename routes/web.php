<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminUsersController;

$redirectIfAuthenticated = function ($request, Closure $next) {
    if ($request->session()->has('user_id')) {
        return redirect('/home');
    }
    return $next($request);
};

Route::group(['middleware' => $redirectIfAuthenticated], function () {
    Route::get('/signin', function () {
        return view('login_register.sign-in');
    })->name('signin');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');

    Route::get('/signup', function () {
        return view('login_register.sign-up');
    })->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/home', [PostController::class, 'index'])->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/new-post', [PostController::class, 'create'])->name('post.create');
Route::post('/store-post', [PostController::class, 'store'])->name('post.store');

Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/categories/{category}', [CategoryController::class, 'showByCategory'])->name('category.posts');

Route::get('/admin', function () {
    return redirect()->route('admin.users');
});

Route::get('/admin/posts', [AdminPostsController::class, 'index'])->name('admin.posts');
Route::get('/admin/posts/create', [AdminPostsController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts/store', [AdminPostsController::class, 'store'])->name('admin.posts.store');
Route::get('/admin/posts/{id}', [AdminPostsController::class, 'show'])->name('admin.posts.show');
Route::get('/admin/posts/{id}/edit', [AdminPostsController::class, 'edit'])->name('admin.posts.edit');
Route::put('/admin/posts/{id}', [AdminPostsController::class, 'update'])->name('admin.posts.update');
Route::delete('/admin/posts/{id}', [AdminPostsController::class, 'destroy'])->name('admin.posts.destroy');

Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users');
Route::delete('/admin/users/{id}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
Route::post('/admin/users/{id}/setadmin', [AdminUsersController::class, 'setAdmin'])->name('admin.users.setadmin');
Route::post('/admin/users/{id}/removeadmin', [AdminUsersController::class, 'removeAdmin'])->name('admin.users.removeadmin');
Route::post('/admin/users/store', [AdminUsersController::class, 'store'])->name('admin.users.store');


Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::get('/admin/users/{id}/password/edit', [AdminUsersController::class, 'editPassword'])->name('admin.users.editpassword');
Route::put('/admin/users/{id}/password/update', [AdminUsersController::class, 'updatePassword'])->name('admin.users.updatepassword');
