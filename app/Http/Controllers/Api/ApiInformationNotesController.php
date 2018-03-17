<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\InformationNotes;

class ApiInformationNotesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $inotes = InformationNotes::where('partnership_id', '=', $id)->get();

        try
        {
            if(!isset($inotes))
            {
                return response()->json(['error' => 'No se encontraron notas de informacion'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['inotes' => $inotes]);
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
            'desc' => 'required',
            'partnership_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'desc' => 'Desc',
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
                $inote = new InformationNotes;
                $inote->desc = $request->desc;
                $inote->partnership_id = $request->partnership_id;
                $inote->save();
                return response()->json(['message' => 'Nota de informacion Guardada', 'inote' => $inote], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar la nota de infomracion'], 400);
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
        $inote = InformationNotes::findOrFail($id);

        try
        {
            if(!isset($inote))
            {
                return response()->json(['error' => 'No se encontro ninguna nota de informacion'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['inote' => $inote]);
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
            'desc' => 'required',
        ]);
        $validator->setAttributeNames([
            'desc' => 'Desc',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $inote = InformationNotes::find($id);
                $inote->desc = $request->desc;
                $inote->save();
                return response()->json(['message' => 'Nota de informacion Actualizada', 'inote' => $inote], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar la nota de infomracion'], 400);
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
            $inote = InformationNotes::find($id);
            $inote->delete();
            return response()->json(['message' => 'Nota de informacion eliminada'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar la Nota de informacion"], 400);
        }

    }
}
