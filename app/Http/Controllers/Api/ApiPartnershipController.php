<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Partnerships;

class ApiPartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partnerships = Partnerships::get();

        try
        {
            if(!isset($partnerships))
            {
                return response()->json(['error' => 'No se encontraron consorcios'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['partnerships' => $partnerships]);
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
            'number' => 'required',
            'suterhcode' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'cuitnumber' => 'required',
            'comment' => 'required',
            'balance' => 'required|email',
            'units' => 'required',
            'premises' => 'required',
            'parkingspaces' => 'required',
            'fee' => 'required',
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

                $partnership = new Partnerships;
                $partnership->name = $request->name;
                $partnership->number = $request->number;
                $partnership->suterhcode = $request->suterhcode;
                $partnership->address = $request->address;
                $partnership->neighborhood = $request->neighborhood;
                $partnership->cuitnumber = $request->cuitnumber;
                $partnership->comment = $request->comment;
                $partnership->balance = $request->balance;
                $partnership->units = $request->units;
                $partnership->premises = $request->premises;
                $partnership->parkingspaces = $request->parkingspaces;
                $partnership->fee = $request->fee;
                $partnership->user_id = $request->user_id;
                $partnership->save();
                return response()->json(['message' => 'Consorcio Guardado'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al guardar el Consorcio"], 400);
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
            'number' => 'required',
            'suterhcode' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'cuitnumber' => 'required',
            'comment' => 'required',
            'balance' => 'required|email',
            'units' => 'required',
            'premises' => 'required',
            'parkingspaces' => 'required',
            'fee' => 'required',
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
                $partnership = Partnerships::find($id);
                $partnership->name = $request->name;
                $partnership->number = $request->number;
                $partnership->suterhcode = $request->suterhcode;
                $partnership->address = $request->address;
                $partnership->neighborhood = $request->neighborhood;
                $partnership->cuitnumber = $request->cuitnumber;
                $partnership->comment = $request->comment;
                $partnership->balance = $request->balance;
                $partnership->units = $request->units;
                $partnership->premises = $request->premises;
                $partnership->parkingspaces = $request->parkingspaces;
                $partnership->fee = $request->fee;
                $partnership->user_id = $request->user_id;
                $partnership->save();
                return response()->json(['message' => 'Consorcio Actualizado'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al actualizar el Consorcio"], 400);
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
            $partnership = Partnerships::find($id);
            $partnership->delete();
            return response()->json(['message' => 'Consorcio eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Consorcio"], 400);
        }
    }
}
