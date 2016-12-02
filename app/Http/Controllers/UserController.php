<?php
/**
 * Created by PhpStorm.
 * User: Nimfus
 * Date: 28.12.15
 * Time: 01:39
 */

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Lang;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\user\EditUserFormRequest;

class UserController extends Controller
{

    public function index() {
        $users = User::all();
        $page_title = 'Users';
        $page_description = 'manage users';
        return view('user.index', compact('users','page_title','page_description'));
    }

    public function newUser() {
        $page_title = 'User';
        $page_description = 'create';
        return view('user.create',compact('page_title','page_description'));
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
                'password' => bcrypt('administrator')
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


    // Edit User
    public function editUser($id)
    {
        $user = User::find($id);

        if(!$user)
            return redirect()->route('users/list')->with('message', Lang::get('response.CUSTOM_MESSAGE_ALERT',['message'=>'Invalid Request']));

        $page_title = 'User';
        $page_description = 'edit';
        return view('user.edit',compact('user','page_title','page_description'));
    }

    /**
     * Update User
     */
    public function updateUser(EditUserFormRequest $request, $id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with('message', Lang::get('response.CUSTOM_MESSAGE_ALERT',['message'=>'Invalid Request']));

        // Update with Inputs
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        
        if (!empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return redirect()->route('users/list')->with('message', Lang::get('response.CUSTOM_MESSAGE_SUCCESS',['message'=>'User updated successfully']));
    }


    /**
     * Delete User
     */
    public function deleteUser($id)
    {
        $data = User::find($id);
        if(!$data)
            return redirect()->back()->with('message', Lang::get('response.CUSTOM_MESSAGE_ALERT',['message'=>'Invalid Request']));

        $data->delete();
        return redirect()->route('users/list')->with('message', Lang::get('response.CUSTOM_MESSAGE_SUCCESS',['message'=>'User deleted successfully']));
    }



    public function showProfile() {
        return view('user.profile');
    }

    public function changePassword(BcryptHasher $hasher) {
        $this->hasher = $hasher;
        $user = User::where('id', Auth::user()->id)->first();
        if(Hash::check($_REQUEST['password'], Auth::user()->password) && $_REQUEST['new_password'] == $_REQUEST['password_confirmation']) {
            $user->password = bcrypt($_REQUEST['new_password']);
            $user->save();
        }
        return redirect('/');
    }

    public function getUsersList()
    {
        $users = User::all(['id', 'name']);
        
        return $users->toJson();
    }
}