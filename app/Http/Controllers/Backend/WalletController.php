<?php

namespace App\Http\Controllers\Backend;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function index() 
    {
        return view('backend.wallet.index');    
    }

    public function serverSideData(Request $request) 
    {
        if($request->ajax()){
            $wallets = Wallet::with('User');

            return DataTables::of($wallets)
                    ->addColumn('account_person', function ($wallet) {
                        if($wallet->User) {
                            return view('backend.wallet.partials.wallet_user', ['user' => $wallet->User]);
                        } else {
                            return '-';
                        }
                    })
                    ->editColumn('created_at', function ($wallet) {
                        return Carbon::parse($wallet->created_at)->format('Y-m-d H:i:s');
                    })
                    ->editColumn('updated_at', function ($wallet) {
                        return Carbon::parse($wallet->updated_at)->format('Y-m-d H:i:s');
                    })
                    ->editColumn('amount', function ($wallet) {
                        return number_format($wallet->amount, 2);
                    })
                    ->rawColumns(['account_person'])
                    ->make(true);
        }    
    }
}
