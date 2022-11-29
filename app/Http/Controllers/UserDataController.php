<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

use \App\Models\Friendship;
use App\Models\FriendRequest;
use \App\Models\Notification;


class UserDataController extends Controller
{
    public function getdata(Request $request) {

        $friends = Friendship::where('account1_id', '=', Auth::user()->id_account)->get();
        $friend_requests = FriendRequest::where('id_receiver', '=', Auth::user()->id_account)->get();

        $limit = 15;

        $notifications = Notification::where('id_receiver', '=', Auth::user()->id_account)->orderByDesc('notification_date')->limit($limit)->get();
        //$notifications2 = Notification::where('id_receiver', '=', Auth::user()->id_account)->where('is_read', '=', true)->orderByDesc('notification_date')->limit($limit - count($notifications))->get();
        

        $notificationViews = [];
        $notificationsCount = 0;
        // $notificationsNotRead = [];
        // $notificationsRead = [];


        foreach ($notifications as $notification) {
            if (!$notification->is_read) $notificationsCount += 1;
            $notificationViews[] = view('partials.leftPanel.notification', ['read' => $notification->is_read, 'description' => $notification->description, 'id' => $notification->id_notification])->render();
        }

        // foreach ($notifications as $notification) {
        //     $notificationsNotRead[] = view('partials.leftPanel.notification', ['read' => false, 'description' => $notification->description, 'id' => $notification->id_notification])->render();
        // }
        // foreach ($notifications2 as $notification) {
        //     $notificationsRead[] = view('partials.leftPanel.notification', ['read' => true, 'description' => $notification->description, 'id' => $notification->id_notification])->render();
        // }

        return response()->json([
            'friends' => $friends,
            'friend_requests' => $friend_requests,
            'notifications' => $notificationViews,
            'new_notis' => $notificationsCount
        ]);
    }

    public function readnotification(Request $request) {

        if (!(count(Notification::where('id_notification', '=', $request['id'])->get()) > 0)) {
            return response("No notification found", 300);
        }

        Notification::where('id_notification', '=', $request['id'])->update(['is_read' => true]);

        $obj = Notification::where('id_notification', '=', $request['id'])->first();

        return response($obj, 200);
    }
}
