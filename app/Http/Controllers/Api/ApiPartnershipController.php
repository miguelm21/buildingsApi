<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;
use JWTAuth;
use Validator;
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
        $partnerships = Partnerships::where('user_id', '=', Auth::id())->get();

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
            /*'address' => 'required',
            'neighborhood' => 'required',*/
            'cuitnumber' => 'required',
            /*'comment' => 'required',*/
            'balance' => 'required',
            'units' => 'required',
            'premises' => 'required',
            'parkingspaces' => 'required',
            'fee' => 'required',
            /*'roela' => 'required',*/
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
                if(isset($request->address))
                {
                    $partnership->address = $request->address;
                }
                if(isset($request->neighborhood))
                {
                    $partnership->neighborhood = $request->neighborhood;
                }
                $partnership->cuitnumber = $request->cuitnumber;
                if(isset($request->comment))
                {
                    $partnership->comment = $request->comment;
                }
                $partnership->balance = $request->balance;
                $partnership->units = $request->units;
                $partnership->premises = $request->premises;
                $partnership->parkingspaces = $request->parkingspaces;
                $partnership->fee = $request->fee;
                if(isset($request->roela))
                {
                    $partnership->roela = $request->roela;
                }
                if(isset($request->roela))
                {
                    $partnership->roela = $request->roela;
                }
                if(isset($request->expense_a))
                {
                    $partnership->expense_a = $request->expense_a;
                }
                if(isset($request->expense_b))
                {
                    $partnership->expense_b = $request->expense_b;
                }
                if(isset($request->expense_c))
                {
                    $partnership->expense_c = $request->expense_c;
                }
                if(isset($request->extraamount))
                {
                    $partnership->extraamount = $request->extraamount;
                }
                if(isset($request->extratype))
                {
                    $partnership->extratype = $request->extratype;
                }
                if(isset($request->expiration))
                {
                    $partnership->expiration = $request->expiration;
                }
                if(isset($request->period))
                {
                    $partnership->period = $request->period;
                }
                if(isset($request->previousbalance))
                {
                    $partnership->previousbalance = $request->previousbalance;
                }
                if(isset($request->lastprorateado))
                {
                    $partnership->lastprorateado = $request->lastprorateado;
                }
                if(isset($request->deadline))
                {
                    $partnership->deadline = $request->deadline;
                }
                $partnership->user_id = $request->user_id;
                $partnership->save();
                return response()->json(['message' => 'Consorcio Guardado', 'partnership' => $partnership], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Consorcio'], 400);
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
        $partnership = Partnerships::findOrFail($id);

        try
        {
            if(!isset($partnership))
            {
                return response()->json(['error' => 'No se encontro ningun consorcio'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['partnership' => $partnership]);
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
            'suterhcode' => 'required',
            /*'address' => 'required',
            'neighborhood' => 'required',*/
            'cuitnumber' => 'required',
            /*'comment' => 'required',*/
            'balance' => 'required',
            'units' => 'required',
            'premises' => 'required',
            'parkingspaces' => 'required',
            'fee' => 'required',
            /*'roela' => 'required',*/
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
            if($request)
            {
                $partnership = Partnerships::find($id);
                $partnership->suterhcode = $request->suterhcode;
                if(isset($request->address))
                {
                    $partnership->address = $request->address;
                }
                if(isset($request->neighborhood))
                {
                    $partnership->neighborhood = $request->neighborhood;
                }
                $partnership->cuitnumber = $request->cuitnumber;
                if(isset($request->comment))
                {
                    $partnership->comment = $request->comment;
                }
                $partnership->balance = $request->balance;
                $partnership->units = $request->units;
                $partnership->premises = $request->premises;
                $partnership->parkingspaces = $request->parkingspaces;
                $partnership->fee = $request->fee;
                if(isset($request->roela))
                {
                    $partnership->roela = $request->roela;
                }
                if(isset($request->expense_a))
                {
                    $partnership->expense_a = $request->expense_a;
                }
                if(isset($request->expense_b))
                {
                    $partnership->expense_b = $request->expense_b;
                }
                if(isset($request->expense_c))
                {
                    $partnership->expense_c = $request->expense_c;
                }
                if(isset($request->extraamount))
                {
                    $partnership->extraamount = $request->extraamount;
                }
                if(isset($request->extratype))
                {
                    $partnership->extratype = $request->extratype;
                }
                if(isset($request->expiration))
                {
                    $partnership->expiration = $request->expiration;
                }
                if(isset($request->period))
                {
                    $partnership->period = $request->period;
                }
                if(isset($request->previousbalance))
                {
                    $partnership->previousbalance = $request->previousbalance;
                }
                if(isset($request->lastprorateado))
                {
                    $partnership->lastprorateado = $request->lastprorateado;
                }
                if(isset($request->deadline))
                {
                    $partnership->deadline = $request->deadline;
                }
                $partnership->user_id = $request->user_id;
                $partnership->save();
                return response()->json(['message' => 'Consorcio Actualizado', 'partnership' => $partnership], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Consorcio'], 400);
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
            return response()->json(['error' => "Error al eliminar el Consorcio"], 400);
        }
    }
}
