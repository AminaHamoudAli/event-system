<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * عرض كل الإشعارات للمستخدم الحالي.
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        return response()->json($notifications);
    }

    /**
     * عرض إشعار محدد.
     */
    public function show($id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);
        return response()->json($notification);
    }

    /**
     * تعليم إشعار كمقروء.
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);
        $notification->update(['read_at' => now()]);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => $notification
        ]);
    }

    /**
     * حذف إشعار.
     */
    public function destroy($id)
    {
        $notification = Notification::where('user_id', auth()->id())
                                    ->findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
