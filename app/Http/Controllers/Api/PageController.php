<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserDataResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\TransactionDetailResource;
use App\Http\Resources\NotificationDetailResource;

class PageController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return success('success', (new UserDataResource($user)));
    }

    public function transaction(Request $request) 
    {
        $transactions = Transaction::with('user', 'source')->orderBy('created_at', 'DESC')->where('user_id', auth()->user()->id);

        if($request->date) {
            $transactions = $transactions->whereDate('created_at', $request->date);
        }

        if($request->type) {
            $transactions = $transactions->where('type', $request->type);
        }

        $transactions = $transactions->paginate(10);

        return TransactionResource::collection($transactions)->additional(['result' => 1, 'message' => 'success']);
    }

    public function transactionDetail($trx_id) 
    {
        $transaction = Transaction::with('user', 'source')->where('trx_id', $trx_id)->where('user_id', auth()->user()->id)->first();
        
        return success('success', new TransactionDetailResource($transaction));
    }

    public function notification() 
    {
        $notifications = auth()->user()->Notifications()->paginate();

        return NotificationResource::collection($notifications)->additional(['result' => 1, 'message' => 'success']);
    }

    public function notificationDetail($id) 
    {
        $notification = auth()->user()->Notifications()->where('id', $id)->first();

        $notification->markAsRead();

        return success('success', new NotificationDetailResource($notification));
    }
}
