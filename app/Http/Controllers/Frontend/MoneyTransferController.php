<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferFormRequest;

class MoneyTransferController extends Controller
{
    public function index() 
    {
        return view('frontend.transfer.index');    
    }

    public function transferConfirm(TransferFormRequest $request) 
    {
        $attributes = $request->validated();
        return view('frontend.transfer.confirm', ['attributes' => $attributes]);    
    }
}
