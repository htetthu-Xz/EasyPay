<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() 
    {
        $notifications = Auth::user()->notifications()->paginate(5);
        return view('frontend.notification.index', ['notifications' => $notifications]);
    }

    public function detail($id) 
    {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();
        return view('frontend.notification.detail', ['notification' => $notification]);
    }
}
