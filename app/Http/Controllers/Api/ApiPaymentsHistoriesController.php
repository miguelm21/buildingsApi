<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use JWTAuth;
use Validator;
use App\Units;
use App\PaymentsHistory;

class ApiPaymentsHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $payments = PaymentsHistory::where('unit_id', '=', $id)->get();

        try
        {
            if(!isset($payments))
            {
                return response()->json(['error' => 'No se encontraron pagos en el historial'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['payments' => $payments]);
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
    {$validator =  Validator::make($request->all(),[ 
            'date' => 'required',
            'amount' => 'required',
            'unit_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'date' => 'Fecha',
            'amount' => 'Monto',
            'observation' => 'Observacion',
            'unit_id' => 'Unidad',
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
                $history = new PaymentsHistory;
                $history->date = $date;
                $history->amount = $request->amount;
                $history->balance = $request->balance;
                if(isset($request->observation))
                {
                    $history->observation = $request->observation;
                }
                $history->unit_id = $request->unit_id;
                if(isset($request->enterent))
                {
                    $history->enterent = $request->enterent;
                }
                if(isset($request->enterexp))
                {
                    $history->enterexp = $request->enterexp;
                }
                if(isset($request->enterdebt))
                {
                    $history->enterdebt = $request->enterdebt;
                }
                if(isset($request->expmonth))
                {
                    $history->expmonth = $request->expmonth;
                }
                if(isset($request->previousbalance))
                {
                    $history->previousbalance = $request->previousbalance;
                }
                if(isset($request->debt))
                {
                    $history->debt = $request->debt;
                }
                if(isset($request->interest))
                {
                    $history->interest = $request->interest;
                }
                $history->save();

                return response()->json(['message' => 'Pago en el Historial Guardado', 'history' => $history], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el pago en el historial'], 400);
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
        $history = PaymentsHistory::findOrFail($id);

        try
        {
            if(!isset($history))
            {
                return response()->json(['error' => 'No se encontro ningun pago en el historial'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['history' => $history]);
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
            'amount' => 'required',
            'observation' => 'required',
            'unit_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'date' => 'Fecha',
            'amount' => 'Monto',
            'observation' => 'Observacion',
            'unit_id' => 'Unidad',
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
                $history = PaymentsHistory::find($request->unit_id);
                $history->date = $date;
                $history->amount = $request->amount;
                $history->balance =  $request->balance;
                $history->observation = $request->observation;
                $history->unit_id = $request->unit_id;
                if(isset($request->enterent))
                {
                    $history->enterent = $request->enterent;
                }
                if(isset($request->enterexp))
                {
                    $history->enterexp = $request->enterexp;
                }
                if(isset($request->enterdebt))
                {
                    $history->enterdebt = $request->enterdebt;
                }
                if(isset($request->expmonth))
                {
                    $history->expmonth = $request->expmonth;
                }
                if(isset($request->previousbalance))
                {
                    $history->previousbalance = $request->previousbalance;
                }
                if(isset($request->debt))
                {
                    $history->debt = $request->debt;
                }
                if(isset($request->interest))
                {
                    $history->interest = $request->interest;
                }
                $history->save();

                return response()->json(['message' => 'Pago en el historial Actualizado', 'history' => $history], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Pago en el historial'], 400);
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
            $history = PaymentsHistory::find($id);
            $history->delete();

            return response()->json(['message' => 'Pago en el historial eliminado'], 200);
        }
        else
        {
            return response()->json(['error' => "Error al eliminar el Pago en el historial"], 400);
        }
    }
}
