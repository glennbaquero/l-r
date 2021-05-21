<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Office;
use App\Models\User;
use App\Models\Group;
use App\Models\City;

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


        View::composer('layouts.header',  function($view) {
            $notifications = auth()->user()->notifications;

            $senders = [
                [
                    'name' => 'All',
                ],
                [
                    'name' => 'User',
                ],
                [
                    'name' => 'Group',
                ],
                [
                    'name' => 'Office',
                ],
                [
                    'name' => 'City',
                ],
            ];

            $users = User::whereNotIn('id', [auth()->user()->id])->get();
            $offices = Office::get();
            $groups = Group::get();
            $cities = City::get();


            $view->with('users', $users);
            $view->with('offices', $offices);
            $view->with('groups', $groups);
            $view->with('cities', $cities);
            $view->with('senders', collect($senders));
            $view->with('notifications', collect($notifications));
        });
    }
}
