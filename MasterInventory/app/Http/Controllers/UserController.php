<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\hash;



class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user',['only'=>['index,show']]);
        $this->middleware('permission:create_user',['only'=>['create,store']]);
        $this->middleware('permission:edit-user',['only'=>['edit','update']]);
        $this->middleware('permission:delete-user',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('users.index',[
            'users'=>User::latest('id')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('users.index',[
            'users'=>User::latest('id')->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) : RedirectResponse

    {
        $input = $request->all();
        $input['password']=Hash::make($request->password);

        $user=User::create($input);
        $user->assignRole($request->roles);
        return redirect()->route('users.index')
        ->withsuccess('New User has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : View
    {
        return view('users.show',[
            'user'=> $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) : View
    {
        //Ascertain only super Admin can update his own details
        if($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'User does not have permissions to edit their details');
            }
        }
        return view('users.edit',[
            'user'=>$user,
            'roles'=>Role::pluck('name')->all(),
            'userRoles'=>$user->roles->pluck('name')->all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {
        $input= $request->all();
        
        if(!empty($request->password)){
            $input['password']=Hash::make($request->password);
        }
            else{
                $input=$request->except('password');
            }

            $user->update($input);

            $user->syncRoles($request->roles);

            return redirect()->back()
            ->withsuccess('The user has been updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->hasRole('super Admin')||$user->id == auth()->user()->id){ //Other users can not delete super-admin
            abort(403, 'User does not have the right permissions');
        }

        $user->syncRoles([]);

        $user->delete();

        return redirect()->route('users.index')
        ->withsuccess('User has been deleted successfully!');

    }
}
