<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\User;

class ApiAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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

    public function authenticate()
    {
        $credentials = request()->only('email', 'password');

        try
        {
            $token = JWTAuth::attempt($credentials);

            if(!$token)
            {
                return response()->json(['error' => 'credenciales invalidas'], 401);
            }
        }
        catch(JWTException $e)
        {
            return response()->json(['error' => 'ocurrio un error'], 500);
        }

        return response()->json(['token' => $token], 200);
    }

    public function register()
    {
        $email = request()->email;
        $name = request()->name;
        $password = request()->password;

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 200);
    }
}
