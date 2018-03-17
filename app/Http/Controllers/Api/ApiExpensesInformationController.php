<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\ExpensesInformation;

class ApiExpensesInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $einformation = ExpensesInformation::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($einformation))
            {
                return response()->json(['error' => 'No se encontraron informaciones de pagos'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['einformation' => $einformation]);
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
            'bank' => 'required',
            'sucursal' => 'required',
            'headline' => 'required',
            'account' => 'required',
            'cbu' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'bank' => 'Banco',
            'sucursal' => 'Sucursal',
            'headline' => 'Titular',
            'account' => 'Numero de Cuenta',
            'cbu' => 'CBU',
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
                $einformation = new ExpensesInformation;
                $einformation->bank = $request->bank;
                $einformation->sucursal = $request->sucursal;
                $einformation->headline = $request->headline;
                $einformation->account = $request->account;
                $einformation->cbu = $request->cbu;
                $einformation->partnership_id = $request->partnership_id;
                $einformation->save();
                return response()->json(['message' => 'Informacion de pago Guardada', 'einformation' => $einformation], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar la informacion de pago'], 400);
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
        $einformation = ExpensesInformation::findOrFail($id);

        try
        {
            if(!isset($einformation))
            {
                return response()->json(['error' => 'No se encontro ninguna informacion de pago'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['einformation' => $einformation]);
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
            'bank' => 'required',
            'sucursal' => 'required',
            'headline' => 'required',
            'account' => 'required',
            'cbu' => 'required',
        ]);
        $validator->setAttributeNames([
            'bank' => 'Banco',
            'sucursal' => 'Sucursal',
            'headline' => 'Titular',
            'account' => 'Numero de Cuenta',
            'cbu' => 'CBU',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $einformation = ExpensesInformation::find($id);
                $einformation->bank = $request->bank;
                $einformation->sucursal = $request->sucursal;
                $einformation->headline = $request->headline;
                $einformation->account = $request->account;
                $einformation->cbu = $request->cbu;
                $einformation->save();
                return response()->json(['message' => 'Informacion de pago Actualizada', 'einformation' => $einformation], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar la informacion de pago'], 400);
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
            $einformation = ExpensesInformation::find($id);
            $einformation->delete();
            return response()->json(['message' => 'Informacion de pago eliminada'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar la Informacion de pago"], 400);
        }
    }
}
