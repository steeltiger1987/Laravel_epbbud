<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 01:39
 */

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    public function newUser() {
        return view('user.create');
    }

    //Creating user from admin panel
    public function createUser() {
        $user = User::where('email', $_REQUEST['email'])->first();
        if($user){
            return 'Such user already exists';
        }else {
            $password = str_random(10);
            $user = new User([
                'name' => $_REQUEST['name'],
                'email' => $_REQUEST['email'],
                'password' => bcrypt($password)
            ]);

            $user->save();

            $email = $user->email;
            Mail::send('mail.new_user', array('email' => $email, 'password' => $password), function($message) use ($email)
            {
                $message->from('mail@gmail.com', 'Site');
                $message->subject('Welcome to ..!');
                $message->to($email);
            });
        }
        return redirect('users');
    }
}