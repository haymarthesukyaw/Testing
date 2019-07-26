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
use Log;
class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $user)
    {
        $this->userService = $user;
    }
    public function showLoginForm()
    {
        return view('auth.login');
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
        // Auth::logout();
        return redirect('/login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget([
            'name',
            'email',
            'type',
            'phone',
            'dob',
            'address',
            'search_name',
            'search_email',
            'search_date_from',
            'search_date_to'
        ]);
        $users = $this->userService->getUser();
        return view('user.userList', compact('users'));
    }

    /**
     * Show user register form.
     */
    public function createForm()
    {
        return view('user.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'  => 'required',
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

        $hide = "*";
        $pwd_hide = str_pad($hide, strlen($pwd), "*");

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
        $users  =  $this->userService->store($auth_id, $user);
        // return view('user.userList',compact('users'));
        return redirect()->intended('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name      = $request->name;
        $email     = $request->email;
        $date_from = $request->dateFrom;
        $date_to   = $request->dateTo;
        if ($email) {
            $validator = Validator::make($request->all(), [
                'email' => 'email',
                'date_from' => 'date',
                'date_to' => 'date|after:date_from'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
        }
        session ([
            'search_name' => $name,
            'search_email'=> $email,
            'search_date_from' => $date_from,
            'search_date_to'   => $date_to
        ]);
        $users = $this->userService->searchUser($name, $email, $date_from, $date_to);
        return view('user.userList', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile($user_id)
    {
        $user_profile=$this->userService->userDetail($user_id);
        return view('user.userProfile',compact('user_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user_detail = $this->userService->userDetail($user_id);
        return view('user.edit',compact('user_detail'));
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
        $user = User::find($user_id);
        $email = $request->email;
        $validator = Validator::make($request->all(), [
            'user_name' =>  'required',
            'email'     =>  'required|email|unique:users,email,' . $user->id,
            'phone'     =>  'required|numeric|digits_between:6,20',
            'address'   =>  'max:255',
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $user   =   new User;
        $user->name    =  $request->user_name;
        $user->email   =  $request->email;
        $user->type    =  $request->type;
        $user->phone   =  $request->phone;
        $user->dob     =  $request->dob;
        $user->address =  $request->address;
        $new_profile   =  $request->file('profile_photo');
        $old_profile   =  $request->oldProfile;

        //tempory save new profile photo
        if ($new_profile) {
            $file_name = $new_profile->getClientOriginalName();
            $new_profile->move('img/tempProfile', $file_name);
            $user->profile = $file_name;
        }
        return view('user.update', compact('user', 'old_profile', 'user_id'));
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
        $auth_id = Auth::user()->id;
        $user   = new User;
        $user->id      =  $user_id;
        $user->name    =  $request->name;
        $user->email   =  $request->email;
        $user->type    =  $request->type;
        $user->phone   =  $request->phone;
        $user->dob     =  $request->dob;
        $user->address =  $request->address;
        $new_profile   =  $request->newProfile;
        $old_profile   =  $request->oldProfile;
        if ($new_profile) {
            $oldpath = public_path() . '/img/tempProfile/' . $new_profile;
            $newpath = public_path() . '/img/profile/' . $new_profile;
            File::move($oldpath, $newpath);
            $user->profile = '/img/profile/' . $new_profile;
        } else {
            $user->profile = $old_profile;
        }
        $update_user  =  $this->userService->update($auth_id, $user);
        if(Auth::user()->type == '0')
        {
            return redirect()->intended('users');
        }
        else
        {
            return redirect()->intended('posts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePwdForm($user_id)
    {
        return view('user.changePwd',compact('user_id'));
    }

    /**
     * Change password the specified resource in storage.
     *Request $request, $user_id
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request,$user_id)
    {
        $validator=Validator::make($request->all(),[
            'old_password' => 'required|min:8|regex:/^(?=.*?[0-9]).{8,}$/',
            'password'     => 'required|min:8|confirmed|regex:/^(?=.*?[0-9]).{8,}$/',
            'password_confirmation' => 'required|same:password'
        ]);
        if($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $old_pwd    =   $request->old_password;
        $new_pwd    =   $request->password;
        $auth_id    =   Auth::user()->id;
        $auth_type  =   Auth::user()->type;
        if (!(Hash::check($old_pwd, Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided.");

        }
        if(strcmp($old_pwd, $new_pwd) == 0) {
            return redirect()->back()->with("error","New Password cannot be same as current password. Please choose a different password.");
        }
        $status =   $this->userService->changePassword($auth_id, $user_id, $old_pwd, $new_pwd);
        return redirect()->route('posts.index');
        // if ($status) {
        //         return redirect()->route('posts.index');
        // }
        // else {
        //     return redirect()->back()->with('incorrect', 'Old password does not match.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->user_id;
        $auth_id = Auth::user()->id;
        $delete_user = $this->userService->softDelete($auth_id, $user_id);
        return redirect()->route('index');
    }

    public function show(Request $request)
    {
        $user = User::findOrFail($request->id);
        $name=$user->name;
        $email=$user->email;
        return response()->json(array('name'=>$name, 'email'=>$email));
    }
}
