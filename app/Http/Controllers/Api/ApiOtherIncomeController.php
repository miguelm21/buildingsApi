<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\OtherIncome;

class ApiOtherIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $oincome = OtherIncome::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($oincome))
            {
                return response()->json(['error' => 'No se encontraron otros ingresos'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['oincome' => $oincome]);
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
            'headline' => 'required',
            'concept' => 'required',
            'amount' => 'required',
            'previousbalance' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'headline' => 'Titulo',
            'concept' => 'Concepto',
            'amount' => 'Monto',
            'previousbalance' => 'Saldo Anterior',
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
                $oincome = new OtherIncome;
                $oincome->headline = $request->headline;
                $oincome->concept = $request->concept;
                $oincome->amount = $request->amount;
                $oincome->previousbalance = $request->previousbalance;
                $oincome->partnership_id = $request->partnership_id;
                $oincome->save();
                return response()->json(['message' => 'Otro ingreso Guardado', 'oincome' => $oincome], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Otro ingreso'], 400);
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
        $oincome = OtherIncome::findOrFail($id);

        try
        {
            if(!isset($oincome))
            {
                return response()->json(['error' => 'No se encontro ninguna otro ingreso'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['oincome' => $oincome]);
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
            'headline' => 'required',
            'concept' => 'required',
            'amount' => 'required',
            'previousbalance' => 'required',
        ]);
        $validator->setAttributeNames([
            'headline' => 'Titulo',
            'concept' => 'Concepto',
            'amount' => 'Monto',
            'previousbalance' => 'Saldo Anterior',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $oincome = OtherIncome::find($id);
                $oincome->headline = $request->headline;
                $oincome->concept = $request->concept;
                $oincome->amount = $request->amount;
                $oincome->previousbalance = $request->previousbalance;
                $oincome->save();
                return response()->json(['message' => 'Otro ingreso Actualizado', 'oincome' => $oincome], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el otro ingreso'], 400);
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
            $oincome = OtherIncome::find($id);
            $oincome->delete();
            return response()->json(['message' => 'Otro ingreso eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Otro ingreso"], 400);
        }
    }
}
