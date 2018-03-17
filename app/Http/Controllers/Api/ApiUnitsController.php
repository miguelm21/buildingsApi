<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Units;

class ApiUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $units = Units::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($units))
            {
                return response()->json(['error' => 'No se encontraron unidades'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['units' => $units]);
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
        header("Content-Type: text/html;charset=utf-8");
        
        $validator =  Validator::make($request->all(),[ 
            'name' => 'required',
           // 'phone' => 'required',
            'floor' => 'required',
            'deparment' => 'required',
            'unit' => 'required',
            'percent_a' => 'required',
          //  'percent_b' => 'required_without_all: percent_a,percent_c',
          //  'percent_c' => 'required_without_all: percent_b,percent_a',
            'previousbalance' => 'required',
            'interests' => 'required',
           // 'mail' => 'required',
           // 'observations' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
           // 'phone' => 'Telefono',
            'floor' => 'Piso',
            'deparment' => 'Departamento',
            'unit' => 'Unidad',
            'percent_a' => 'Porcentaje A',
         //   'percent_b' => 'Porcentaje B',
         //   'percent_c' => 'Porcentaje C',
            'debt' => 'Debito',
            'previousbalance' => 'Saldo Anterior',
            'prorateado' => 'Prorateado',
            'interests' => 'Intereses',
          //  'mail' => 'Correo',
          //  'observations' => 'Observacion',
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
                $units = new Units;
                $units->name = $request->name;
                $units->phone = $request->phone;
                $units->floor = $request->floor;
                $units->deparment = $request->deparment;
                $units->unit = $request->unit;
                $units->percent_a = $request->percent_a;
                $units->percent_b = $request->percent_b;
                $units->percent_c = $request->percent_c;
                $units->previousbalance = $request->previousbalance;
                if(isset($request->privateexpense))
                {
                  $units->privateexpense = $request->privateexpense;
                }
                if(isset($request->amountpayment ))
                {
                  $units->amountpayment  = $request->amountpayment;
                }
                else
                {
                  $units->amountpayment = 0;
                }
                $units->interests = $request->interests;
                if(isset($request->previousinterest))
                {
                  $units->previousinterest = $request->previousinterest;
                }
                $units->mail = $request->mail;
                $units->observations = $request->observations;
                $units->partnership_id = $request->partnership_id;

                if(isset($request->debt))
                {
                    $units->debt = $request->debt;
                }

                if(isset($request->prorateado))
                {
                    $units->prorateado = $request->prorateado;
                }

                if(isset($request->enterEnt))
                {
                    $units->enterEnt = $request->enterEnt;
                }
                if(isset($request->enterExp))
                {
                    $units->enterExp = $request->enterExp;
                }
                if(isset($request->enterDebt))
                {
                    $units->enterDebt = $request->enterDebt;
                }
                if(isset($request->expA))
                {
                    $units->expA = $request->expA;
                }
                if(isset($request->expB))
                {
                    $units->expB = $request->expB;
                }
                if(isset($request->expC))
                {
                    $units->expC = $request->expC;
                }
                if(isset($request->expTotal))
                {
                    $units->expTotal = $request->expTotal;
                }
                if(isset($request->extraShare))
                {
                    $units->extraShare = $request->extraShare;
                }
                if(isset($request->fechaAcreditacion))
                {
                    $units->fechaAcreditacion = $request->fechaAcreditacion;
                }
                $units->save();
                return response()->json(['message' => 'Unidad Guardada', 'units' => $units], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar la Unidad'], 400);
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
        $units = Units::findOrFail($id);

        try
        {
            if(!isset($units))
            {
                return response()->json(['error' => 'No se encontro ninguna unidad'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['units' => $units]);
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
/*            'name' => 'required',*/
         //   'phone' => 'required',
/*            'floor' => 'required',
            'deparment' => 'required',
            'unit' => 'required',
            'percent_a' => 'required',*/
         //   'percent_b' => 'required',
/*         //   'percent_c' => 'required',
            'previousbalance' => 'required',
            'enterinterests' => 'required',*/
         //   'mail' => 'required',
         //   'observations' => 'required',
/*            'partnership_id' => 'required',*/
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
          //  'phone' => 'Telefono',
            'floor' => 'Piso',
            'deparment' => 'Departamento',
            'unit' => 'Unidad',
            'percent_a' => 'Porcentaje A',
          //  'percent_b' => 'Porcentaje B',
          //  'percent_c' => 'Porcentaje C',
            'debt' => 'Debito',
            'previousbalance' => 'Saldo Anterior',
            'prorateado' => 'Prorateado',
            'interests' => 'Intereses',
          //  'mail' => 'Correo',
          //  'observations' => 'Observacion',
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
                $units = Units::find($id);
                if(isset($request->name))
                {
                  $units->name = $request->name;
                }
                if(isset($request->phone))
                {
                  $units->phone = $request->phone;
                }
                if(isset($request->floor))
                {
                  $units->floor = $request->floor;
                }
                if(isset($request->deparment))
                {
                  $units->deparment = $request->deparment;
                }
                if(isset($request->unit))
                {
                  $units->unit = $request->unit;
                }
                if(isset($request->percent_a))
                {
                  $units->percent_a = $request->percent_a;
                }
                if(isset($request->percent_b))
                {
                  $units->percent_b = $request->percent_b;
                }
                if(isset($request->percent_c))
                {
                  $units->percent_c = $request->percent_c;
                }
                if(isset($request->previousbalance))
                {
                  $units->previousbalance = $request->previousbalance;
                }
                if(isset($request->privateexpense))
                {
                  $units->privateexpense = $request->privateexpense;
                }
                if(isset($request->interests))
                {
                  $units->interests = $request->interests;
                }
                if(isset($request->previousinterest))
                {
                  $units->previousinterest = $request->previousinterest;
                }
                if(isset($request->mail))
                {
                  $units->mail = $request->mail;
                }
                if(isset($request->observations))
                {
                  $units->observations = $request->observations;
                }
                if(isset($request->partnership_id))
                {
                  $units->partnership_id = $request->partnership_id;
                }
                if(isset($request->debt))
                {
                    $units->debt = $request->debt;
                }
                if(isset($request->debt))
                {
                    $units->prorateado = $request->prorateado;
                }
                if(isset($request->enterEnt))
                {
                    $units->enterEnt = $request->enterEnt;
                }
                if(isset($request->enterExp))
                {
                    $units->enterExp = $request->enterExp;
                }
                if(isset($request->enterDebt))
                {
                    $units->enterDebt = $request->enterDebt;
                }
                if(isset($request->expA))
                {
                    $units->expA = $request->expA;
                }
                if(isset($request->expB))
                {
                    $units->expB = $request->expB;
                }
                if(isset($request->expC))
                {
                    $units->expC = $request->expC;
                }
                if(isset($request->expTotal))
                {
                    $units->expTotal = $request->expTotal;
                }
                if(isset($request->extraShare))
                {
                    $units->extraShare = $request->extraShare;
                }
                if(isset($request->fechaAcreditacion))
                {
                    $units->fechaAcreditacion = $request->fechaAcreditacion;
                }
                if(isset($request->amountpayment ))
                {
                  $units->amountpayment  = $request->amountpayment;
                }
                else
                {
                  $units->amountpayment = 0;
                }

                $units->save();
                return response()->json(['message' => 'Unidad Actualizada', 'units' => $units], 200);
            }
            else
            {
                return response()->json(['message'=>'Error al actualizar la Unidad'], 400);
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
            $units = Units::find($id);
            $units->delete();
            return response()->json(['message' => 'Unidad eliminada'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar la Unidad"], 400);
        }
    }
}
