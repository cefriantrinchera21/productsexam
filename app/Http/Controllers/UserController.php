<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $search = trim($request->get('search'));
        $users = User::UserSearch($search); 
        return view('users.index',compact('search','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $password = md5($request->input('password'));
        $is_admin = $request->input('is_admin');
        $uuid = Str::uuid()->toString();

        $data_user = array(
            'email'=>strtolower($email),
            'name'=>strtoupper($name),
            'password'=>$password,
            'is_admin'=>$is_admin,
            'user_uuid'=>$uuid
        );
        
        User::create($data_user);
      
        return back()->with('success','USER SUCCESSFULLY CREATED!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_user(UserEditRequest $request){

        $password = $request->input('password_update');
        $email = $request->input('email_update');
        $user_id = $request->input('user_id');
        $name = $request->input('name_update');

        $user_row = User::where('id',$user_id)->first();

        if(!empty($password)){
            $password_post = md5($password);    
        }else{
            $password_post = $user_row->password;
        }

        if($email == $user_row->email){
            $email_post = $email;
        }else{
            $email_row = User::where('email',$email)->first();
            if(!empty($email_row )){
                return back()->with('danger','EMAIL ALREADY EXIST!');
            }else{
                $email_post = $email;
            }
        }

       
        $is_admin = $request->input('is_admin_update');
        $dept_id = $request->input('dept_id_update');

        $signature = $request->file('signature_update');
        
        $data_user = array(
            'email'=>strtolower($email_post),
            'name'=>strtoupper($name),
            'password'=>$password_post,
            'is_admin'=>$is_admin,
        );

        User::where('id', $user_id )->update($data_user);
        return back()->with('success','USER SUCCESSFULLY UPDATED!');

    }
}
