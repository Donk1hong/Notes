<?php

namespace App\Http\Controllers\Api\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\StoreUserRequest;
use App\Http\Requests\Api\Users\UpdateUserRequest;
use App\Models\User;

class UsersController extends Controller
{

    public function index()
    {

    }

    public function store(StoreUserRequest $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
