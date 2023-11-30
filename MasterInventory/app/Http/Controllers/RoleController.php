<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role',['only'=>['index','show']]);
        $this->middleware('permission:create-role',['only'=>['create','store']]);
        $this->middleware('permission:edit-role',['only'=>['edit','update']]);
        $this->middleware('permission:delete-role',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('roles.index',[
            'roles'=>Role::orderby('id', 'DESC')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : view
    {
        return view('roles.create',[
            'permissions'=>Permission::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request) : RedirectResponse
    {
        $role=Role::create(['name'=> $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
        ->withSuccess('The new role has been assigned successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) :View
    {
        $rolePermissions=Permission::join("role_has_permissions","permission_id","=","id")
        ->where("role_id",$role->id)
        ->select('name')
        ->get();

        return view('roles.show',[
            'role'=>$role,
            'rolePermissions'=>$rolePermissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) : View
    {
        if($role->name=='Super Admin'){
            abort(403, 'Super Admin role can not be edited!');
        }
        $rolePermissions=DB::table("role_has_permissions")->where("role_id",$role->id)
        ->pluck('permission_id')
        ->all();
        return view('roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::get(),
            'rolePermissions'=>$rolePermissions

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role) : RedirectResponse
    {
        $input=$request->only('name');
        $role->update($input);
        $role->syncPermissions($request->permissions);

        return redirect()->back()
        ->withsuccess('role has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) : RedirectResponse
    {
        if($role->name=='Super Admin'){
        abort(403, 'Super Admin role cannot be deleted!');
        }
        if (auth()->user()->hasRole($role->name)){
            abort(403, 'Self-assigned role cannot be deleted!');
        }
        $role->delete();
        return redirect()->route('roles.index')
        ->withsuccess('Role has been deleted successfully');
    }
}
