<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Providers;

class ApiProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Providers::get();

        try
        {
            if(!isset($providers))
            {
                return response()->json(['error' => 'No se encontraron proveedores'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['providers' => $providers]);
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
            'address' => 'required',
        //    'phone' => 'required',
        //    'type' => 'required',
            'cuitnumber' => 'required',
        //    'comment' => 'required',
        //    'concept' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
            'address' => 'Direccion',
        //    'phone' => 'Telefono',
        //    'type' => 'Tipo',
            'cuitnumber' => 'Numero de Cuit',
        //    'comment' => 'Observacion',
        //    'concept' => 'Concepto',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {

                $provider = new Providers;
                $provider->name = $request->name;
                $provider->address = $request->address;
                if(isset($request->phone))
                {
                    $provider->phone = $request->phone;
                }
                if(isset($request->type))
                {
                    $provider->type = $request->type;
                }
                if(isset($request->comment))
                {
                    $provider->comment = $request->comment;
                }
                if(isset($request->concept))
                {
                    $provider->concept = $request->concept;
                }
                $provider->cuitnumber = $request->cuitnumber;
                $provider->save();
                return response()->json(['message' => 'Proveedor Guardado', 'provider' => $provider], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Proveedor'], 400);
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
        $provider = Providers::findOrFail($id);

        try
        {
            if(!isset($provider))
            {
                return response()->json(['error' => 'No se encontro ningun proveedor'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['provider' => $provider]);
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
        $validator =  Validator::make($request->all(),[ 
            'address' => 'required',
        //    'phone' => 'required',
        //    'type' => 'required',
            'cuitnumber' => 'required',
        //    'comment' => 'required',
         //   'concept' => 'required',
        ]);
        $validator->setAttributeNames([
            'address' => 'Direccion',
        //    'phone' => 'Telefono',
        //    'type' => 'Tipo',
            'cuitnumber' => 'Numero de Cuit',
        //    'comment' => 'Observacion',
        //    'concept' => 'Concepto',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $provider = Providers::find($id);
                $provider->address = $request->address;
                $provider->cuitnumber = $request->cuitnumber;
                if(isset($request->phone))
                {
                    $provider->phone = $request->phone;
                }
                if(isset($request->type))
                {
                    $provider->type = $request->type;
                }
                if(isset($request->comment))
                {
                    $provider->comment = $request->comment;
                }
                if(isset($request->concept))
                {
                    $provider->concept = $request->concept;
                }
                $provider->save();
                return response()->json(['message' => 'Proveedor Actualizado', 'provider' => $provider], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Proveedor'], 400);
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
            $provider = Providers::find($id);
            $provider->delete();
            return response()->json(['message' => 'Proveedor eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Proveedor"], 400);
        }
    }

    public function types()
    {
        $typ = Providers::select('type')->distinct('type')->get();

        $types = [];

        foreach($typ as $t)
        {
            array_push($types, $t->type);
        }

        try
        {
            if(!isset($types))
            {
                return response()->json(['error' => 'No se encontro ningun tipo'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['types' => $types]);

    }
}
