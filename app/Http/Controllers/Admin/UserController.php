<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($id)
    {
        // View user details
    }

    public function destroy($id)
    {
        // Delete user logic
        return back()->with('success', 'User deleted successfully.');
    }
}
