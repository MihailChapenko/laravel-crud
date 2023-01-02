<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('users.users', [
            'users' => User::where('id', '!=', 1)->get(),
        ]);
    }

    public function create(CreateUserRequest $request)
    {
        $newUser = [
            'name' => $request->input('userName'),
            'email' => $request->input('userEmail'),
            'password' => Hash::make($request->input('password'))
        ];

        $user = $this->user->create($newUser);
        if(is_null($user)) {
            return response()->json(['error' => 'user was not created'], 400);
        }

        return response()->json(['success' => true]);
    }

    public function find(Request $request)
    {
        $user = $this->user->find($request->input('id'));

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function edit(Request $request)
    {
        $editUser = [
            'name' => $request->input('userName'),
            'email' => $request->input('userEmail'),
        ];

        $user = $this->user->find($request->input('id'));
        $user->update($editUser);

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $this->user->find($request->input('id'))->delete();

        return response()->json(['success' => true]);
    }
}
