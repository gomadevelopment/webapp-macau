<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;

class NotificationsController extends Controller
{
    public function markNotificationsAsRead()
    {
        $data = request()->only('notifications_ids');

        if(isset($data['notifications_ids'])){
            foreach($data['notifications_ids'] as $notification_id){
                $notification = Notification::find($notification_id);
                $notification->active = 0;
                $notification->save();
            }
        }
    }

    public function updateNotifications()
    {
        $data = request()->only('current_unread_limit', 'current_read_limit', 'show_less', 'nav_bar_notifications');
        $no_more_notifications = false;
        // dd($data);
            if($data['show_less'] == 'true' && !isset($data['nav_bar_notifications'])){
                $unread_notifications = auth()->user()->getUnreadNotifications(5)->get();
                $read_notifications = auth()->user()->getReadNotifications(5)->get();
            }
            else{
                $unread_limit = $data['current_unread_limit'] == 0 ? 0 : $data['current_unread_limit'] + 5;
                $unread_notifications = auth()->user()->getUnreadNotifications($unread_limit)->get();

                // if($unread_notifications->count() == auth()->user()->unread_notifications->count()){
                //     $read_limit = $data['current_read_limit'] + 5;
                // }
                // else{
                //     $read_limit = 0;
                // }

                $read_limit = $data['current_read_limit'] + 5;
                $read_notifications = auth()->user()->getReadNotifications($read_limit)->get();
            }
            
            if($unread_notifications->count() == auth()->user()->unread_notifications->count() &&
                $read_notifications->count() == auth()->user()->read_notifications->count()){
                $no_more_notifications = true;
            }

            if(!isset($data['nav_bar_notifications'])){
                $view = view()->make("classroom.classroom-partials.notifications-partial", [
                    'unread_notifications' => $unread_notifications,
                    'read_notifications' => $read_notifications
                ]);
                $html = $view->render();
            }
            else{
                $view = view()->make("layouts.notifications-partial", [
                    'unread_user_notifications' => $unread_notifications,
                    'read_user_notifications' => $read_notifications
                ]);
                $html = $view->render();
            }
            
        return response()->json([
            'status' => 'success',
            'no_more_notifications' => $no_more_notifications,
            'html' => $html
        ]);
    }
}
