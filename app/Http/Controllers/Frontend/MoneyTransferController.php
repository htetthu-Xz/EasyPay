<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferFormRequest;
use Illuminate\Support\Facades\Hash;

class MoneyTransferController extends Controller
{
    public function index() 
    {
        return view('frontend.transfer.index');    
    }

    public function transferConfirm(TransferFormRequest $request) 
    {
        $attributes = $request->validated();

        $receiver_user = User::where('phone', $attributes['to_phone'])->first();

        if(!$receiver_user) {
            return back()->withErrors(['to_phone' => 'This phone number is not registered with Easy Pay.'])->withInput();
        }

        if(auth()->user()->phone == $attributes['to_phone']) {
            return back()->withErrors(['to_phone' => 'You can not transfer money to yourself.'])->withInput();
        }

        $attributes['receiver_id'] = $receiver_user->id;

        $this->setTransferData($attributes);

        dd(session('data'));

        return view('frontend.transfer.confirm', ['attributes' => $attributes, 'receiver_user' => $receiver_user]);    
    }

    public function checkPhone(Request $request) 
    {
        if($request->ajax()) {
           if(auth()->user()->phone != $request->phone) {
                $user = User::where('phone', $request->phone)->first();

                if($user) {
                    return response()->json([
                        'status' => 'success',
                        'data' => $user
                    ]);
                }
           }

           return response()->json([
                'status' => 'fail'
            ]);
        }
    }

    public function checkPassword(Request $request) 
    {
        if($request->ajax()) {

            if(!$request->password) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Password is incorrect.'
                ]);
            }

           if(Hash::check($request->password, auth()->user()->password)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password is correct.'
                ]);
           }

            return response()->json([
                'status' => 'fail',
                'message' => 'Password is incorrect.'
            ]);
        }
    }

    public function transferComplete(Request $request) 
    {
        
    }

    private function setTransferData($data) {
        session()->put('data', $data);
    }

    private function getTransferData($data) {
        return session('data');
    }

    private function destroyTransferData($data) {
        session()->forget('data');
    }
}
