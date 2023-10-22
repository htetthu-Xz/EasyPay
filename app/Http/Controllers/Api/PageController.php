<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserDataResource;
use App\Models\Transaction;

class PageController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return success('success', (new UserDataResource($user)));
    }

    public function transaction() 
    {
        $transactions = Transaction::with('user', 'source')->orderBy('created_at', 'DESC')->where('user_id', auth()->user()->id)->paginate(10);
        
        return success('success', (TransactionResource::collection($transactions)));
    }

    public function transactionDetail($trx_id) 
    {
        $transactions = Transaction::paginate(10);
        
        // return success('success', ());
    }
}
