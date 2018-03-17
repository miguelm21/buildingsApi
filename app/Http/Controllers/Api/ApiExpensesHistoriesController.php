<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use JWTAuth;
use Validator;
use App\Partnerships;
use App\ExpensesHistory;

class ApiExpensesHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $date1, $date2)
    {
        $expenses = ExpensesHistory::where('partnership_id', '=', $id)->whereBetween('date2', [$date1, $date2])->get();

        try
        {
            if(!isset($expenses))
            {
                return response()->json(['error' => 'No se encontraron gastos en el historial'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['expenses' => $expenses]);
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
            'igPorDeuda' => 'required',
            'igPorExpMes' => 'required',
            'igPorInt' => 'required',
            'igPorExtra' => 'required',
            'egresos' => 'required',
            'previousbalance' => 'required',
            'totalIg' => 'required',
            'date' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'igPorDeuda' => 'igPorDeuda',
            'igPorExpMes' => 'igPorExpMes',
            'igPorInt' => 'igPorInt',
            'igPorExtra' => 'Extraordinario',
            'egresos' => 'Gasto',
            'previousbalance' => 'Gasto Anterior',
            'totalIg' => 'totalIg',
            'date' => 'Fecha',
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
                $date = date("r", strtotime($request->date));
                $history = new ExpensesHistory;
                $history->igPorDeuda = $request->igPorDeuda;
                $history->igPorExpMes = $request->igPorExpMes;
                $history->igPorInt = $request->igPorInt;
                $history->igPorExtra = $request->igPorExtra;
                $history->egresos = $request->egresos;
                $history->totalIg = $request->totalIg;
                $history->date = $date;
                $history->date2 = $request->date;
                $history->partnership_id = $request->partnership_id;
                $history->save();

                return response()->json(['message' => 'Gasto del Consorcio Guardado', 'history' => $history], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Gasto del Consorcio'], 400);
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
        $history = ExpensesHistory::findOrFail($id);

        try
        {
            if(!isset($history))
            {
                return response()->json(['error' => 'No se encontro ningun gasto del Consorcio'], 401);
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
            'igPorDeuda' => 'required',
            'igPorExpMes' => 'required',
            'igPorInt' => 'required',
            'igPorExtra' => 'required',
            'egresos' => 'required',
            'totalIg' => 'required',
            'date' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'igPorDeuda' => 'igPorDeuda',
            'igPorExpMes' => 'igPorExpMes',
            'igPorInt' => 'igPorInt',
            'igPorExtra' => 'Extraordinario',
            'egresos' => 'Gasto',
            'totalIg' => 'totalIg',
            'date' => 'Fecha',
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
                $date = date("r", strtotime($request->date));
                $history = ExpensesHistory::find($request->unit_id);
                $history->igPorDeuda = $request->igPorDeuda;
                $history->igPorExpMes = $request->igPorExpMes;
                $history->igPorInt = $request->igPorInt;
                $history->igPorExtra = $request->igPorExtra;
                $history->egresos = $request->egresos;
                $history->totalIg = $request->totalIg;
                $history->date = $date;
                $history->date2 = $request->date;
                $history->partnership_id = $request->partnership_id;
                $history->save();

                return response()->json(['message' => 'Gasto del Consorcio Actualizado', 'history' => $history], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Gasto del Consorcio'], 400);
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
            $history = ExpensesHistory::find($id);
            $history->delete();

            return response()->json(['message' => 'Gasto del Consorcio eliminado'], 200);
        }
        else
        {
            return response()->json(['error' => "Error al eliminar el Gasto del Consorcio"], 400);
        }
    }

    public function getDates($id, $date1, $date2)
    {
        $expenses = ExpensesHistory::where('partnership_id', '=', $id)->whereBetween('date2', [$date1, $date2])->get();

        try
        {
            if(!isset($expenses))
            {
                return response()->json(['error' => 'No se encontraron gastos del Consorcio'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['expenses' => $expenses]);
    }
}
