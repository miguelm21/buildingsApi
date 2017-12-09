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
            'enterinterests' => 'required',
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
            'enterinterests' => 'Intereses',
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
                $units->enterinterests = $request->enterinterests;
                $units->mail = $request->mail;
                $units->observations = $request->observations;
                $units->partnership_id = $request->partnership_id;

                if(isset($request->debt))
                {
                    $units->debt = $request->debt;
                }

                if(isset($request->debt))
                {
                    $units->prorateado = $request->prorateado;
                }
                $units->save();
                return response()->json(['message' => 'Unidad Guardada'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al guardar la Unidad"], 400);
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
            'name' => 'required',
         //   'phone' => 'required',
            'floor' => 'required',
            'department' => 'required',
            'unit' => 'required',
            'percent_a' => 'required',
         //   'percent_b' => 'required',
         //   'percent_c' => 'required',
            'previousbalance' => 'required',
            'enterinterests' => 'required',
         //   'mail' => 'required',
         //   'observations' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre',
          //  'phone' => 'Telefono',
            'floor' => 'Piso',
            'department' => 'Departamento',
            'unit' => 'Unidad',
            'percent_a' => 'Porcentaje A',
          //  'percent_b' => 'Porcentaje B',
          //  'percent_c' => 'Porcentaje C',
            'debt' => 'Debito',
            'previousbalance' => 'Saldo Anterior',
            'prorateado' => 'Prorateado',
            'enterinterests' => 'Intereses',
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
                return $request->mail;
                $units = Units::find($id);
                $units->name = $request->name;
                $units->phone = $request->phone;
                $units->floor = $request->floor;
                $units->department = $request->department;
                $units->unit = $request->unit;
                $units->percent_a = $request->percent_a;
                $units->percent_b = $request->percent_b;
                $units->percent_c = $request->percent_c;
                $units->previousbalance = $request->previousbalance;
                $units->enterinterests = $request->enterinterests;
                $units->mail = $request->mail;
                $units->observations = $request->observations;
                $units->partnership_id = $request->partnership_id;

                if(isset($request->debt))
                {
                    $units->debt = $request->debt;
                }

                if(isset($request->debt))
                {
                    $units->prorateado = $request->prorateado;
                }

                $units->save();
                return response()->json(['message' => 'Unidad Actualizada'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al actualizar la Unidad"], 400);
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
