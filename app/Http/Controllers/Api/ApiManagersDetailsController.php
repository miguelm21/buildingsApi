<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\ManagerSalaryDetail;

class ApiManagersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $mdetails = ManagerSalaryDetail::where('manager_id', '=', $id)->get();

        try
        {
            if(!isset($mdetails))
            {
                return response()->json(['error' => 'No se encontraron detalles'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['mdetails' => $mdetails]);
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
            'manager_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'key' => 'Key',
            'value' => 'Value',
            'manager_id' => 'Responsable',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $mdetail = new ManagerSalaryDetail;
                $mdetail->key = $request->key;
                $mdetail->value = $request->value;
                $mdetail->manager_id = $request->manager_id;
                $mdetail->save();
                return response()->json(['message' => 'Detalle Guardado', 'mdetail' => $mdetail], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Detalle'], 400);
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
        $mdetail = ManagerSalaryDetail::findOrFail($id);

        try
        {
            if(!isset($mdetail))
            {
                return response()->json(['error' => 'No se encontro ningun detalle'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['mdetail' => $mdetail]);
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
                $mdetail = ManagerSalaryDetail::find($id);
                $mdetail->key = $request->key;
                $mdetail->value = $request->value;
                $mdetail->save();
                return response()->json(['message' => 'Detalle Actualizado', 'mdetail' => $mdetail], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el detalle'], 400);
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
            $mdetail = ManagerSalaryDetail::find($id);
            $mdetail->delete();
            return response()->json(['message' => 'Detalle eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Detalle"], 400);
        }
    }
}
