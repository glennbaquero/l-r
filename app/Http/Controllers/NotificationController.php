<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;
use App\Models\Office;
use App\Models\User;
use App\Models\Group;
use App\Models\City;
use App\Models\Reply;

use Illuminate\Notifications\DatabaseNotification;

use App\Notifications\NotifyUser;

class NotificationController extends Controller
{

    /**
     * Update the office of the current user logged in
     * 
     * @return Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = auth()->user();

        $user->update([
            'office_id' => $request->office_id
        ]);

        return response()->json([
            'message' => 'Office succesfully update',
            'success' => true
        ]);
    }

    /**
     * Notify the users
     * 
     * @return Illuminate\Http\Response
     */
    public function notification(Request $request)
    {

        if($request->send_to != 'All') {
            $ids = json_decode($request->ids);
        }

        switch ($request->send_to) {
            case 'User':
                $users = User::whereIn('id', $ids)->get();
                break;
            
            case 'Group':
                $users = User::whereIn('group_id', $ids)->get();
                break;
            
            case 'Office':
                $users = User::whereIn('office_id', $ids)->get();
                break;
            
            case 'City':
                $office_ids = Office::whereIn('departure_city_id', $ids)->get()->pluck('id');
                $users = User::whereIn('office_id', $office_ids)->get();
                break;
            
            default:
                $users = User::whereNotIn('id', auth()->user()->id)->get();
                break;
        }

        foreach ($users as $key => $user) {
            $user->notify(new NotifyUser($request->message, $request->subject));
        }

        return response()->json([
            'message' => 'Notification sent succesfully',
            'success' => true
        ]);
    }

    /**
     * Notification Read
     * 
     * @return Illuminate\Http\Response
     */
    public function notificationRead(Request $request)
    {

        $user = auth()->user();

        $unread = $user->notifications()->whereNull('read_at')->update([
                'read_at' => now()
            ]);

        return response()->json([
            'message' => 'Notification read succesfully',
            'success' => true,
        ]);
    }

    /**
     * Notification Read
     * 
     * @return Illuminate\Http\Response
     */
    public function replyToNotification(Request $request, $id)
    {

        $notification = DatabaseNotification::find($id);

        $sender = User::withTrashed()->findOrFail($notification->data['sender_id']);

        $subject = $notification->data['title'];

        Reply::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $sender->id,
            'notification_id' => $notification->id,
            'message' => $notification->data['message']   
        ]);

        $sender->notify(new NotifyUser($request->message, $subject, true));

        return response()->json([
            'message' => 'Reply read succesfully',
            'success' => true,
        ]);
    }
}
