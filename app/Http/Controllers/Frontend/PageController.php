<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function home() : View 
    {
        return view('frontend.home');
    }   

    public function profile() 
    {
        return view('frontend.profile');    
    }

    public function getPasswordUpdateForm() 
    {
        return view('frontend.update_password');    
    }

    public function updatePassword(Request $request) 
    {
        $attributes = $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $user = Auth::user();

        if(Hash::check($attributes['old_password'], $user->password)) {
            $user->update([
                'password' => $attributes['new_password']
            ]);

            return redirect()->route('profile.page')->with(['success' => 'Your password successfully updated.']);
        }

        return back()->with(['message' => 'Your old password is incorrect!']);
    }

    public function wallet() 
    {
        return view('frontend.wallet');    
    }

    public function transaction(Request $request) 
    {
        $transactions = Transaction::with('User', 'Source')
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('created_at', 'DESC');

        if($request->type) {
            $transactions = $transactions->where('type', $request->type);
        }

        if($request->date) {
            $transactions = $transactions->whereDate('created_at', $request->date);
        }

        $transactions = $transactions->paginate(5);

        return view('frontend.transaction', ['transactions' => $transactions]);    
    }

    public function transactionDetail($trx_id) 
    {
        $transaction = Transaction::with('User', 'Source')->where('user_id', auth()->user()->id)->where('trx_id', $trx_id)->first();
        return view('frontend.transaction_detail', ['transaction' => $transaction]);    
    }
}
