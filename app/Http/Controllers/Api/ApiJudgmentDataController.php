<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\JudgmentData;

class ApiJudgmentDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $jdata = JudgmentData::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($jdata))
            {
                return response()->json(['error' => 'No se encontraron datos de juicios'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['jdata' => $jdata]);
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
            'expedientnumber' => 'required',
            'place' => 'required',
            'object' => 'required',
            'status' => 'required',
            'amount' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'expedientnumber' => 'Numero de Expediente',
            'place' => 'Lugar',
            'object' => 'Objeto',
            'status' => 'Estatus',
            'amount' => 'Monto',
            'partnership_id' => 'Pago',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $jdata = new JudgmentData;
                $jdata->expedientnumber = $request->expedientnumber;
                $jdata->place = $request->place;
                $jdata->object = $request->object;
                $jdata->status = $request->status;
                $jdata->amount = $request->amount;
                $jdata->partnership_id = $request->partnership_id;
                $jdata->save();
                return response()->json(['message' => 'Dato de juicio Guardado', 'jdata' => $jdata], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Dato de juicio'], 400);
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
        $jdata = JudgmentData::findOrFail($id);

        try
        {
            if(!isset($jdata))
            {
                return response()->json(['error' => 'No se encontro ninguna dato de juicio'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['jdata' => $jdata]);
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
            'expedientnumber' => 'required',
            'place' => 'required',
            'object' => 'required',
            'status' => 'required',
            'amount' => 'required',
        ]);
        $validator->setAttributeNames([
            'expedientnumber' => 'Numero de Expediente',
            'place' => 'Lugar',
            'object' => 'Objeto',
            'status' => 'Estatus',
            'amount' => 'Monto',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $jdata = JudgmentData::find($id);
                $jdata->expedientnumber = $request->expedientnumber;
                $jdata->place = $request->place;
                $jdata->object = $request->object;
                $jdata->status = $request->status;
                $jdata->amount = $request->amount;
                $jdata->save();
                return response()->json(['message' => 'Dato de juicio Actualizado', 'jdata' => $jdata], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Dato de juicio'], 400);
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
            $jdata = JudgmentData::find($id);
            $jdata->delete();
            return response()->json(['message' => 'Dato de juicio eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Dato de juicio"], 400);
        }
    }
}
