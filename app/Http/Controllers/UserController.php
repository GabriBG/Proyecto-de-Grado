<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }



    public function store(Request $request)
    {

        
            $ID->Select('MAX(id) from personas');
        

            $campos=[
                'username'=>'required|string|max:15',
                'email'=>'required|email',
                'password'=>'required|string|max:15',
            ];

            $mensaje=[
                'required'=>'El :attribute es requerido'
            ];

            $this->validate($request, $campos,$mensaje);


        $user=new User;
        $user->username=$request->get('username');
        $user->email=$request->get('email');
        $user->password=$request->get('password');

        $user->save();

        return Redirect::to('users');
    }
}
