<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServiceInterface;
use App\Services\User\UserService;
use App\Http\Controllers\Redirect;
use App\Models\User;
use Validator;
use Auth;
use Hash;
use File;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $user)
    {
        $this->userService = $user;
    }
    public function login(Request $request)
    {
        $email      =   $request->email;
        $pwd        =   $request->password;
        $validator  =   Validator::make($request->all(), [
            'email'     =>  'required|email',
            'password'  =>  'required|min:8|regex:/^(?=.*?[0-9]).{8,}$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if (Auth::guard('')->attempt(['email' => $email, 'password' => $pwd, 'deleted_at' => null])) {
            return redirect()->intended('/posts');
        }else {
            return redirect()->back()
                        ->with('incorrect', 'Email or password incorrect!')
                        ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    /**
     * Show user register form.
     */
    public function createForm()
    {
        return view('user.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.userList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'  =>  'required',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|min:8|confirmed|regex:/^(?=.*?[0-9]).{8,}$/',
            'password_confirmation' => 'required|min:8|regex:/^(?=.*?[0-9]).{8,}$/',
            'phone'     =>  'required|numeric|digits_between:6,20',
            'address'   =>  'max:255',
            'profileImg'   =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $name    =  $request->user_name;
        $email   =  $request->email;
        $pwd     =  $request->password;
        $type    =  $request->type;
        $phone   =  $request->phone;
        $dob     =  $request->dob;
        $address =  $request->address;
        $profile_img = $request->file('profileImg');

        //password show as ***
        $hide = "*";
        $pwd_hide = str_pad($hide, strlen($pwd), "*");
        //tempory save profile photo
        $filename = "";
        if ($profile_img) {
            $filename = $profile_img->getClientOriginalName();
            $profile_img->move('img/tempProfile', $filename);
        }
        session ([
            'name'  => $name,
            'email' => $email,
            'type'  => $type,
            'phone' => $phone,
            'dob'   => $dob,
            'address' => $address
        ]);
        return view('user.createConfirm', compact(
            'name', 'email','pwd', 'type', 'phone', 'dob', 'address', 'pwd_hide', 'filename'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_id    =  Auth::user()->id;
        //save profile image
        $filename  =  $request->filename;
        if ($filename) {
            $oldpath    =  public_path() . '/img/tempProfile/' . $filename;
            $newpath    =  public_path() . '/img/profile/' . $filename;
            File::move($oldpath, $newpath);
            $profile    =  '/img/profile/' . $filename;
        } else {
            $profile    =  '';
        }
        $user_type      =  $request->type;
        if ($user_type == null) {
            $user_type = '1';
        }
        $user           =  new User;
        $user->name     =  $request->user_name;
        $user->email    =  $request->email;
        $user->password =  Hash::make($request->password);
        $user->type     =  $user_type;
        $user->phone    =  $request->phone;
        $user->dob      =  $request->dob;
        $user->address  =  $request->address;
        $user->profile  =  $profile;
        $insert_user  =  $this->userService->store($auth_id, $user);
        return view('user.userList');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        return view('user.userProfile');
    }
    public function showProfileEdit()
    {
        return view('user.edit');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        return view('user.edit');
    }

    /**
     * Update Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editConfirm(Request $request, $user_id)
    {
        return view('user.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        return view('user.userList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePwdForm()
    {
        return view('user.changePwd');
    }

    /**
     * Change password the specified resource in storage.
     *Request $request, $user_id
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('user.userList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
