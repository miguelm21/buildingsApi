<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Contributions;

class ApiContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $contributions = Contributions::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($contributions))
            {
                return response()->json(['error' => 'No se encontraron Aportes'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['contributions' => $contributions]);
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
            'key' => 'required',
            'value' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'key' => 'Key',
            'value' => 'Value',
            'partnership_id' => 'Consorcio',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $contribution = new Contributions;
                $contribution->key = $request->key;
                $contribution->value = $request->value;
                $contribution->partnership_id = $request->partnership_id;
                $contribution->save();
                return response()->json(['message' => 'Aporte Guardado', 'contribution' => $contribution], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Aporte'], 400);
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
        $contribution = Contributions::findOrFail($id);

        try
        {
            if(!isset($contribution))
            {
                return response()->json(['error' => 'No se encontro ningun aporte'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['contribution' => $contribution]);
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
            'key' => 'required',
            'value' => 'required',
        ]);
        $validator->setAttributeNames([
            'key' => 'Key',
            'value' => 'Value',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $contribution = Contributions::find($id);
                $contribution->key = $request->key;
                $contribution->value = $request->value;
                $contribution->save();
                return response()->json(['message' => 'Aporte Actualizado', 'contribution' => $contribution], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Aporte'], 400);
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
            $contribution = Contributions::find($id);
            $contribution->delete();
            return response()->json(['message' => 'Aporte eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Aporte"], 400);
        } 
    }
}
