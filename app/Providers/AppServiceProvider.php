<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Category;


use Illuminate\Pagination\Paginator;


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
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrapFive();


        // Sử dụng View Composer để chia sẻ $categories với menu.blade.php
        View::composer('user.partials.menu', function ($view) {
            $categories = Category::with('subCategories')->get();
            $view->with('categories', $categories);
        });


        // Tạo các vai trò và phân quyền
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Permission::firstOrCreate(['name' => 'access admin panel']);

        // Gán quyền cho vai trò admin
        $adminRole->givePermissionTo('access admin panel');

    }
}
