<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AccountNumberGenerator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index');
    }

    public function serverSideData(Request $request)
    {
        if($request->ajax()) {
            $data = User::query();

            return DataTables::of($data)
                ->editColumn('user_agent', function($user) {
                    if($user->user_agent) {
                        $agent = new Agent();
                        $agent->setUserAgent($user->user_agent);
                        $device = $agent->device();
                        $platform = $agent->platform();
                        $browser = $agent->browser();
                        return view('backend.user.partials.user_agent', [
                            'platform' => $platform,
                            'device' => $device,
                            'browser' => $browser
                        ]);
                    } else {
                        return '-';
                    }
                })
                ->editColumn('updated_at', function($user) {
                    return Carbon::parse($user->updated_at)->format('Y-m-d');
                })
                ->editColumn('login_at', function($user) {
                    if($user->login_at) {
                        return Carbon::parse($user->login_at)->format('Y-m-d H:i:s');
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function($user) {
                    return view('backend.user.partials.table_action', ['user' => $user]);
                })
                ->rawColumns(['action', 'user_agent'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $user = User::create($request->validated());

            Wallet::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'user_id' => $user->id,
                    'account_number' => AccountNumberGenerator::GenerateNumber(),
                ]
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Something Wrong' . $e->getMessage()])->withInput();
        }
        
        DB::commit();
        return redirect()->route('users.index')->with(['success' => 'User successfully created.']);
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        
        try {
            
            $user->update($request->validated());

            Wallet::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'user_id' => $user->id,
                    'account_number' => AccountNumberGenerator::GenerateNumber(),
                ]
            );
            DB::commit();
            return redirect()->route('users.index')->with(['success' => 'User successfully updated.']);
            
        } catch (\Exception $e) {
            dd('f');
            DB::rollBack();
            return back()->withErrors(['error' => 'Something Wrong' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Request $request, User $user)
    {
        if($request->ajax()) {
            $user->delete();
        }
    }
}
