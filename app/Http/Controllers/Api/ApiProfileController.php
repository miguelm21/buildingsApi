<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
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
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'name' => 'required',
            'residence' => 'required',
            'zipcode' => 'required',
            'cuitnumber' => 'required',
            'phone' => 'required',
            'rpaenrollment' => 'required',
            'fiscalsituation' => 'required',
            'email' => 'required|email',
            'website' => 'required',
        ]);
        $validator->setAttributeNames([
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmacion de Contraseña',
            'name' => 'Nombre',
            'residence' => 'Residencia',
            'zipcode' => 'Codigo Postal',
            'cuitnumber' => 'Numero CUIT',
            'phone' => 'Telefono',
            'rpaenrollment' => 'Inscripción R.P.A',
            'fiscalsituation' => 'Situacion Fiscal',
            'email' => 'Correo',
            'website' => 'Sitio Web'
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->save();

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
                $profile->user_id = $user->id;
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
        $profile = Profile::findOrFail($id);

        try
        {
            if(!isset($profile))
            {
                return response()->json(['error' => 'No se encontro ningun perfil'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['profile' => $profile]);
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
            'residence' => 'Domicilio',
            'zipcode' => 'Cod. Postal',
            'cuitnumber' => 'N° de CUIT',
            'phone' => 'Telefono',
            'rpaenrollment' => 'Inscripción R.P.A',
            'fiscalsituation' => 'Situacion Fiscal',
            'email' => 'Mail',
            'website' => 'Pagina Web',
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
                return response()->json(["error'=>'Error al actualizar el Administrador"], 400);
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
