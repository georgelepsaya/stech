<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        $userId = auth()->id();
        $notifications = Notification::where('user_id', $userId)->get();
        return view('notifications.index', compact('notifications'));
    }

    public function toggleRead($id) {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->read = !$notification->read;
            $notification->save();
            return response()->json(['status' => 'success', 'read' => $notification->read]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Notification not found'], 404);
        }
    }
}
