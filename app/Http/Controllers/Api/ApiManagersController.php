<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Managers;

class ApiManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Managers::get();

        try
        {
            if(!isset($managers))
            {
                return response()->json(['error' => 'No se encontraron responsables'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['managers' => $managers]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id)
    {
        $managers = Managers::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($managers))
            {
                return response()->json(['error' => 'No se encontraron responsables'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['managers' => $managers]);
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
            'cuilnumber' => 'required',
            'partnership_number' => 'required',
            'dateadmission' => 'required',
            'category' => 'required',
            'amount_a' => 'required',
            'amount_b' => 'required',
            'amount_c' => 'required',
            'charge' => 'required',
            'period' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre y Apellido',
            'cuilnumber' => 'Numero de Cuil',
            'partnership_number' => 'Numero de Consorcio',
            'dateadmission' => 'Fecha',
            'category' => 'Categoria',
            'amount_a' => 'Asignacion A',
            'amount_b' => 'Asignacion B',
            'amount_c' => 'Asignacion C',
            'charge' => 'Cargo',
            'period' => 'Periodo',
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
                $date = date("r", strtotime($request->dateadmission));
                $manager = new Managers;
                $manager->name = $request->name;
                $manager->cuilnumber = $request->cuilnumber;
                $manager->partnership_number = $request->partnership_number;
                $manager->dateadmission = $date;
                $manager->category = $request->category;
                if(isset($request->amount_a))
                {
                    $manager->amount_a = $request->amount_a;
                }
                if(isset($request->amount_b))
                {
                    $manager->amount_b = $request->amount_b;
                }
                if(isset($request->amount_c))
                {
                    $manager->amount_c = $request->amount_c;
                }
                $manager->charge = $request->charge;
                $manager->period = $request->period;
                $manager->partnership_id = $request->partnership_id;
                $manager->save();
                return response()->json(['message' => 'Responsable Guardado', 'manager' => $manager], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar el Responsable'], 400);
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
        $manager = Managers::findOrFail($id);

        try
        {
            if(!isset($manager))
            {
                return response()->json(['error' => 'No se encontro ningun encargado'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['manager' => $manager]);
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
/*            'name' => 'required',
            'cuilnumber' => 'required',
            'partnership_number' => 'required',
            'dateadmission' => 'required',
            'category' => 'required',
            'amount_a' => 'required',
            'amount_b' => 'required',
            'amount_c' => 'required',
            'charge' => 'required',
            'period' => 'required',*/
        ]);
        $validator->setAttributeNames([
            'name' => 'Nombre y Apellido',
            'cuilnumber' => 'Numero de Cuil',
            'partnership_number' => 'Numero de Consorcio',
            'dateadmission' => 'Fecha',
            'category' => 'Categoria',
            'amount_a' => 'Asignacion A',
            'amount_b' => 'Asignacion B',
            'amount_c' => 'Asignacion C',
            'charge' => 'Cargo',
            'period' => 'Periodo',
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
                $manager = Managers::find($id);
                if(isset($request->name))
                {
                    $manager->name = $request->name;
                }
                if(isset($request->cuilnumber))
                {
                    $manager->cuilnumber = $request->cuilnumber;
                }
                if(isset($request->partnership_number))
                {
                    $manager->partnership_number = $request->partnership_number;
                }
                if(isset($request->date))
                {
                    $manager->dateadmission = $date;
                }
                if(isset($request->category))
                {
                    $manager->category = $request->category;
                }
                if(isset($request->amount_a))
                {
                    $manager->amount_a = $request->amount_a;
                }
                if(isset($request->amount_b))
                {
                    $manager->amount_b = $request->amount_b;
                }
                if(isset($request->amount_c))
                {
                    $manager->amount_c = $request->amount_c;
                }
                if(isset($request->charge))
                {
                    $manager->charge = $request->charge;
                }
                if(isset($request->period))
                {
                    $manager->period = $request->period;
                }
                $manager->save();
                return response()->json(['message' => 'Responsable Actualizado', 'manager' => $manager], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar el Responsable'], 400);
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
            $manager = Managers::find($id);
            $manager->delete();
            return response()->json(['message' => 'Responsable eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar el Responsable"], 400);
        }
    }
}
