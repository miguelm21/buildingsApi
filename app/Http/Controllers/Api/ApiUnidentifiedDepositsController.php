<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\UnidentifiedDeposits;

class ApiUnidentifiedDepositsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $udeposits = UnidentifiedDeposits::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($udeposits))
            {
                return response()->json(['error' => 'No se encontraron depositos no identificados'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['udeposits' => $udeposits]);
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

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[ 
            'date' => 'required',
            'import' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'date' => 'Fecha',
            'import' => 'Importe',
            'partnership_id' => 'Gasto',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $date = date("r", strtotime($request->date));
                $udeposit = new UnidentifiedDeposits;
                $udeposit->date = $date;
                $udeposit->import = $request->import;
                $udeposit->partnership_id = $request->partnership_id;
                $udeposit->save();
                return response()->json(['message' => 'Deposito no identificado Guardado', 'udeposit' => $udeposit], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Deposito no identificado'], 400);
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
        $udeposit = UnidentifiedDeposits::findOrFail($id);

        try
        {
            if(!isset($udeposit))
            {
                return response()->json(['error' => 'No se encontro ningun Deposito no identificado'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['udeposit' => $udeposit]);
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
            'date' => 'required',
            'import' => 'required',
        ]);
        $validator->setAttributeNames([
            'date' => 'Fecha',
            'import' => 'Importe',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $date = date("r", strtotime($request->date));
                $udeposit = UnidentifiedDeposits::find($id);
                $udeposit->date = $date;
                $udeposit->import = $request->import;
                $udeposit->save();
                return response()->json(['message' => 'Deposito no identificado Actualizado', 'udeposit' => $udeposit], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Deposito no identificado'], 400);
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
            $udeposit = UnidentifiedDeposits::find($id);
            $udeposit->delete();
            return response()->json(['message' => 'Deposito no identificado eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Deposito no identificado"], 400);
        }

    }
}
