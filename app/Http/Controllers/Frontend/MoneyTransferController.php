<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UuidGenerator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferFormRequest;
use App\Models\Transaction;
use Exception;

class MoneyTransferController extends Controller
{
    public function index() 
    {
        $this->destroyTransferData();

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
        DB::beginTransaction();

        try {
            $from_account = Auth::user();
        
            $transfer_data = $this->getTransferData();
    
            $to_account = User::where('id', $transfer_data['receiver_id'])->first();
    
            $to_account->Wallet->increment('amount', $transfer_data['amount']);
    
            $from_account->Wallet->decrement('amount', $transfer_data['amount']);

            $ref_number = UuidGenerator::GenerateRefNumber();

            $from_account_transaction = Transaction::create([
                'ref_no' => $ref_number,
                'trx_id' => UuidGenerator::GenerateTransactionId(),
                'user_id' => $from_account->id,
                'type' => 2,
                'amount' => $transfer_data['amount'],
                'source_id' => $to_account->id,
                'description' => $transfer_data['description'],
            ]);

            $to_account_transaction = Transaction::create([
                'ref_no' => $ref_number,
                'trx_id' => UuidGenerator::GenerateTransactionId(),
                'user_id' => $to_account->id,
                'type' => 1,
                'amount' => $transfer_data['amount'],
                'source_id' => $from_account->id,
                'description' => $transfer_data['description'],
            ]);

            $this->destroyTransferData();
            
            DB::commit();
            
            return redirect()->route('transaction.detail', $from_account_transaction->trx_id)->with('success', 'Money successfully transferred.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('transfer.index')->with('message', 'Something wrong.');
        }
    }

    private function setTransferData($data) {
        session()->put('data', $data);
    }

    private function getTransferData() {
        return session('data');
    }

    private function destroyTransferData() {
        session()->forget('data');
    }
}
