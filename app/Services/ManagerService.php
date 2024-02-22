<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerService
{
    public function all() {
        return User::where('role', 'manager')->get();
    }

    public function create($data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'manager'
        ]);
    }

    public function destroy($id) {
        return User::destroy($id);
    }

    public function get($id) {
        return User::find($id);
    }

    public function update($data, $id) {
        return User::where('id', $id)->update($data);
    }
}
