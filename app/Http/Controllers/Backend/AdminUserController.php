<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;

class AdminUserController extends Controller
{

    public function index()
    {
        return view('backend.admin.index');
    }

    public function serverSideData(Request $request)
    {
        if($request->ajax()) {
            $data = AdminUser::query();

            return DataTables::of($data)
                ->editColumn('user_agent', function($admin) {
                    if($admin->user_agent) {
                        $agent = new Agent();
                        $agent->setUserAgent($admin->user_agent);
                        $device = $agent->device();
                        $platform = $agent->platform();
                        $browser = $agent->browser();
                        return view('backend.admin.partials.user_agent', [
                            'platform' => $platform,
                            'device' => $device,
                            'browser' => $browser
                        ]);
                    } else {
                        return '-';
                    }
                })
                ->editColumn('created_at', function($admin) {
                    return Carbon::parse($admin->created_at)->format('Y-m-d');
                })
                ->editColumn('updated_at', function($admin) {
                    return Carbon::parse($admin->updated_at)->format('Y-m-d');
                })
                ->addColumn('action', function($admin) {
                    return view('backend.admin.partials.table_action', ['admin' => $admin]);
                })
                ->rawColumns(['action', 'user_agent'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('backend.admin.create');
    }

    public function store(AdminUserRequest $request)
    {
        AdminUser::create($request->validated());

        return redirect()->route('admin-user.index')->with(['success' => 'Admin successfully created.']);
    }

    public function show($id)
    {
        //
    }

    public function edit(AdminUser $admin_user)
    {
        return view('backend.admin.edit', ['admin_user' => $admin_user]);
    }

    public function update(AdminUserRequest $request, AdminUser $admin_user)
    {
        $admin_user->update($request->validated());

        return redirect()->route('admin-user.index')->with(['success' => 'Admin successfully updated.']);
    }

    public function destroy(Request $request, AdminUser $admin_user)
    {
        if($request->ajax()) {
            $admin_user->delete();
        }
    }
}
