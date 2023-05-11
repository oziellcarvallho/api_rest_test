<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission.api:user-view',          ['only' => ['index', 'show']]);
        $this->middleware('permission.api:user-create',        ['only' => ['store']]);
        $this->middleware('permission.api:user-edit',          ['only' => ['update']]);
        $this->middleware('permission.api:user-delete',        ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $fields = $request->only([
            'name', 'email', 'cpf', 'type'
        ]);

        $fields['password'] = Hash::make($request->password);
        
        $user = User::create($fields);

        return response()->json([
            'message' => 'User successfully created',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $fields = $request->only([
            'name', 'email', 'cpf', 'type'
        ]);
        
        if ($request->has('password')) {
            $fields['password'] = Hash::make($request->password);
        }
        
        $user->update($fields);

        return response()->json([
            'message' => 'User successfully updated',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User successfully deleted',
            'user' => $user
        ]);
    }
}
