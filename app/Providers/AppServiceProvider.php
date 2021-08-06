<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Office;
use App\Models\User;
use App\Models\Group;
use App\Models\City;

use Aws\Sns\SnsClient;
use App\Channels\SmsChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Aws\Credentials\Credentials;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
            return new SmsChannel(
            new SnsClient([
                'version' => '2010-03-31',
                'credentials' => new Credentials(
                    config('services.sns.key'),
                    config('services.sns.secret')
                ),
                    'region' => config('services.sns.region'),
                ])
            );
         });
        });

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
