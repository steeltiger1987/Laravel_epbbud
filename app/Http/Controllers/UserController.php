<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 01:39
 */

namespace App\Http\Controllers;
use App\User;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }
}