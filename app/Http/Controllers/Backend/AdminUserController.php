<?php

namespace App\Http\Controllers\Backend;

use App\Models\AdminUser;
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

            return DataTables::of($data)->make(true);
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
