<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Profile;
use App\User;

class ApiProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::get();

        try
        {
            if(!isset($profiles))
            {
                return response()->json(['error' => 'No se encontraron administradores'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['profiles' => $profiles]);
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
        $validator =  Validator::make($request->all(),[ 
            'name' => 'required',
            'residence' => 'required',
            'zipcode' => 'required',
            'cuitnumber' => 'required',
            'phone' => 'required',
            'rpaenrollment' => 'required',
            'fiscalsituation' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'user_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {

                $profile = new Profile;
                $profile->name = $request->name;
                $profile->residence = $request->residence;
                $profile->zipcode = $request->zipcode;
                $profile->cuitnumber = $request->cuitnumber;
                $profile->phone = $request->phone;
                $profile->rpaenrollment = $request->rpaenrollment;
                $profile->fiscalsituation = $request->fiscalsituation;
                $profile->email = $request->email;
                $profile->website = $request->website;
                $profile->user_id = $request->user_id;
                $profile->save();
                return response()->json(['message' => 'Administrador Guardado'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al guardar el Administrador"], 400);
            }
        }
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
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'residence' => 'required',
            'zipcode' => 'required',
            'cuitnumber' => 'required',
            'phone' => 'required',
            'rpaenrollment' => 'required',
            'fiscalsituation' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'user_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $profile = Profile::find($id);
                $profile->name = $request->name;
                $profile->residence = $request->residence;
                $profile->zipcode = $request->zipcode;
                $profile->cuitnumber = $request->cuitnumber;
                $profile->phone = $request->phone;
                $profile->rpaenrollment = $request->rpaenrollment;
                $profile->fiscalsituation = $request->fiscalsituation;
                $profile->email = $request->email;
                $profile->website = $request->website;
                $profile->user_id = $request->user_id;
                $profile->save();
                return response()->json(['message' => 'Administrador Actualizado'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al actualizar el Administrador"], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id))
        {
            $profile = Profile::find($id);
            $profile->delete();
            return response()->json(['message' => 'Administrador eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Administrador"], 400);
        }
    }
}