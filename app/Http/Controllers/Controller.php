<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homepage()
    {
        if(auth()->user()){
            $this->viewShareNotifications();
        }
        
        return view('homepage');
    }

    public function setLocale($locale = 'pt')
    {
        if (!in_array($locale, ['pt', 'en'])){
            $locale = 'pt';
        }
        \Session::put('locale', $locale);
        return redirect()->to('/');
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
