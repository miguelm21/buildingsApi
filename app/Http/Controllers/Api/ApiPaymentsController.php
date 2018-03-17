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

class ApiPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $payments = Units::get();

        try
        {
            if(!isset($payments))
            {
                return response()->json(['error' => 'No se encontraron pagos'], 401);
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
    {
        $validator =  Validator::make($request->all(),[ 
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
                $payment = Units::find($request->unit_id);
                $payment->datepayment = $date; 
                
                if($request->amount == 0)
                {
                    $payment->amountpayment = $request->amount;
                }
                else
                {
                    $payment->amountpayment = $payment->amountpayment + $request->amount;
                }
                if(isset($request->observation))
                {
                    $payment->observationpayment = $request->observation;
                }
                $payment->save();
                
                return response()->json(['message' => 'Pago Guardado', 'payment' => $payment], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Pago'], 400);
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
        $payment = Units::findOrFail($id);

        try
        {
            if(!isset($payment))
            {
                return response()->json(['error' => 'No se encontro ningun pago'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['payment' => $payment]);
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
                $payment = Units::find($request->unit_id);
                $payment->datepayment = $date;
                $payment->amountpayment = $request->amount;
                if(isset($request->observation))
                {
                    $payment->observationpayment = $request->observation;
                }
                $payment->save();

                return response()->json(['message' => 'Pago Actualizado', 'payment' => $payment], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Pago'], 400);
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
            $payment = Units::find($id);
            $payment->delete();

            return response()->json(['message' => 'Pago eliminado'], 200);
        }
        else
        {
            return response()->json(['error' => "Error al eliminar el Pago"], 400);
        }
    }
}
