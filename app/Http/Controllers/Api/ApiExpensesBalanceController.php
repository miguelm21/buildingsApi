<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\ExpensesBalace;

class ApiExpensesBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $balance = ExpensesBalace::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($balance))
            {
                return response()->json(['error' => 'No se encontraron Balances de Gasto'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['balance' => $balance]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        $balance = ExpensesBalace::where('unit_id', '=', $id)->get();

        try
        {
            if(!isset($balance))
            {
                return response()->json(['error' => 'No se encontraron Balances de Gasto'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['balance' => $balance]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index3($id)
    {
        $expenses = Expenses::where('provider_id', '=', $id)->get();

        try
        {
            if(!isset($expenses))
            {
                return response()->json(['error' => 'No se encontraron Gasto'], 401);
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
            'concept' => 'required', 
            'name' => 'required',
            'date' => 'required',
            'amount_a' => 'required',
            'amount_b' => 'required',
            'amount_c' => 'required',
            'rubro' => 'required',
            'concept' => 'required',
            'provider_id' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'concept' => 'Concepto',
            'name' => 'Nombre',
            'date' => 'Fecha',
            'amount_a' => 'Monto a',
            'amount_b' => 'Monto b',
            'amount_c' => 'Monto c',
            'rubro' => 'Rubro',
            'concept' => 'Concepto',
            'provider_id' => 'Proveedor',
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
                $expense = new ExpensesBalace;
                $expense->name = $request->name;
                $expense->concept = $request->concept;
                $expense->date = $date;
                if(isset($request->dues))
                {
                    $expense->dues = $request->dues;
                }
                if(isset($request->duestotal))
                {
                    $expense->duestotal = $request->duestotal;
                }
                $expense->amount_a = $request->amount_a;
                $expense->amount_b = $request->amount_b;
                $expense->amount_c = $request->amount_c;
                $expense->rubro = $request->rubro;
                
                if(isset($request->period))
                {
                    $expense->period = $request->period;
                }
                if(isset($request->previousbalance))
                {
                    $partnership->previousbalance = $request->previousbalance;
                }
                if(isset($request->debt))
                {
                    $partnership->debt = $request->debt;
                }
                if(isset($request->int))
                {
                    $partnership->int = $request->int;
                }
                if(isset($request->factnumber))
                {
                    $expense->factnumber = $request->factnumber;
                }
                if(isset($request->year))
                {
                    $expense->year = $request->year;
                }
                if(isset($request->provider_id))
                {
                    $expense->provider_id = $request->provider_id;
                }
                if(isset($request->unit_id))
                {
                    $expense->unit_id = $request->unit_id;
                }
                $expense->partnership_id = $request->partnership_id;
                $expense->save();
                return response()->json(['message' => 'Gasto Guardado', 'expense' => $expense], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Gasto'], 400);
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
        $balance = ExpensesBalace::findOrFail($id);

        try
        {
            if(!isset($balance))
            {
                return response()->json(['error' => 'No se encontro ningun Balance de Gasto'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['balance' => $balance]);
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
            /*'name' => 'required',
            'date' => 'required',
            'amount_a' => 'required',
            'amount_b' => 'required',
            'amount_c' => 'required',
            'rubro' => 'required',
            'concept' => 'required',
            'period' => 'required',
            'provider_id' => 'required',*/
        ]);
        $validator->setAttributeNames([
            'concept' => 'Concepto',
            'name' => 'Nombre',
            'date' => 'Fecha',
            'amount_a' => 'Monto a',
            'amount_b' => 'Monto b',
            'amount_c' => 'Monto c',
            'rubro' => 'Rubro',
            'repeat' => 'Repetir',
            'provider_id' => 'Proveedor',
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
                $expense = Expenses::find($id);
                if(isset($request->concept))
                {
                    $expense->concept = $request->concept;
                }
                if(isset($request->name))
                {
                    $expense->name = $request->name;
                }
                if(isset($request->dues))
                {
                    $expense->dues = $request->dues;
                }
                if(isset($request->duestotal))
                {
                    $expense->duestotal = $request->duestotal;
                }
                if(isset($request->date))
                {
                    $expense->date = $date;
                }
                if(isset($request->amount_a))
                {
                    $expense->amount_a = $request->amount_a;
                }
                if(isset($request->amount_b))
                {
                    $expense->amount_b = $request->amount_b;
                }
                if(isset($request->amount_c))
                {
                    $expense->amount_c = $request->amount_c;
                }
                if(isset($request->rubro))
                {
                    $expense->rubro = $request->rubro;
                }
                if(isset($request->repeat))
                {
                    $expense->repeat = $request->repeat;
                }
                if(isset($request->factnumber))
                {
                    $expense->factnumber = $request->factnumber;
                }
                if(isset($request->hidden))
                {
                    $expense->hidden = $request->hidden;
                }
                if(isset($request->provider_id))
                {
                    $expense->provider_id = $request->provider_id;
                }
                $expense->save();
                return response()->json(['message' => 'Balance de Gasto Actualizado', 'expense' => $expense], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Balance de Gasto'], 400);
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
            $expense = ExpensesBalace::find($id);
            $expense->delete();
            return response()->json(['message' => 'Balance eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Balance"], 400);
        }
    }
}
