<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin(UsersDataTable $dataTables) {
        return $dataTables->render('dashboard.accounts.index');
    }
}
