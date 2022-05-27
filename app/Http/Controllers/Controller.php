<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

    public function technicalFile()
    {
        if(auth()->user()){
            $this->viewShareNotifications();
        }
        
        return view('technical-file');
    }

    public function faqs()
    {
        if(auth()->user()){
            $this->viewShareNotifications();
        }
        
        return view('faqs');
    }

    public function privacy()
    {
        if(auth()->user()){
            $this->viewShareNotifications();
        }
        
        return view('privacy');
    }


    public function setLocale($locale = 'pt')
    {
        if (!in_array($locale, ['pt', 'en', 'cnn'])){
            $locale = 'pt';
        }
        \Session::put('locale', $locale);
        return redirect()->back();
    }

    public function viewShareNotifications()
    {
        $unread_user_notifications = auth()->user()->getUnreadNotifications(5)->get();
        $read_user_notifications = auth()->user()->getReadNotifications(10)->get();
        view()->share(compact('unread_user_notifications', 'read_user_notifications'));
    }
}
