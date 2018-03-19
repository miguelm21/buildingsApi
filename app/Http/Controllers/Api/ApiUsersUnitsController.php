<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Auth;
use Validator;
use App\UsersUnits;

class ApiUsersUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = UsersUnits::where('user', '=', Auth::id())->get();

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
            'datestart' => 'required',
            'dateend' => 'required',
            'type' => 'required',
            'description' => 'required',
            'summary' => 'required',
/*            'attachment' => 'required',
            'codepayment' => 'required',
            'noticeamountpayment' => 'required',
            'noticedatepayment' => 'required',
            'noticedescpayment' => 'required',*/
            'user_id' => 'required',
        ]);
        $validator->setAttributeNames([
            'datestart' => 'Fecha de Inicio',
            'dateend' => 'Fecha de Culminacion',
            'type' => 'Tipo',
            'description' => 'Descripcion',
            'summary' => 'Resumen',
            'attachment' => 'Archivo',
            'codepayment' => 'Codigo de Pago',
            'noticeamountpayment' => 'Pago',
            'noticedatepayment' => 'Fecha',
            'noticedescpayment' => 'Desc',
            'user_id' => 'Usuario',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $date1 = date("r", strtotime($request->datestart));
                $date2 = date("r", strtotime($request->dateend));

                $units = new UsersUnits;
                $units->datestart = $date1;
                $units->datestart2 = $request->datestart;
                $units->dateend = $date2;
                $units->dateend2 = $request->dateend;
                $units->type = $request->type;
                $units->description = $request->description;
                $units->summary = $request->summary;
                if(isset($request->attachment))
                {
                  $units->attachment = $request->attachment;
                }
                if(isset($request->codepayment ))
                {
                  $units->codepayment  = $request->codepayment;
                }
                if(isset($request->noticeamountpayment ))
                {
                  $units->noticeamountpayment  = $request->noticeamountpayment;
                }
                if(isset($request->noticedatepayment ))
                {
                  $units->noticedatepayment  = $request->noticedatepayment;
                }
                if(isset($request->noticedescpayment ))
                {
                  $units->noticedescpayment  = $request->noticedescpayment;
                }
                $units->user_id = $request->user_id;
                $units->save();
                return response()->json(['message' => 'Usuario de Unidad Guardado', 'units' => $units], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar'], 400);
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
        $units = UsersUnits::findOrFail($id);

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
            /*'datestart' => 'required',
            'dateend' => 'required',
            'type' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'attachment' => 'required',
            'codepayment' => 'required',
            'noticeamountpayment' => 'required',
            'noticedatepayment' => 'required',
            'noticedescpayment' => 'required',
            'user_id' => 'required',*/
        ]);
        $validator->setAttributeNames([
            'datestart' => 'Fecha de Inicio',
            'dateend' => 'Fecha de Culminacion',
            'type' => 'Tipo',
            'description' => 'Descripcion',
            'summary' => 'Resumen',
            'attachment' => 'Archivo',
            'codepayment' => 'Codigo de Pago',
            'noticeamountpayment' => 'Pago',
            'noticedatepayment' => 'Fecha',
            'noticedescpayment' => 'Desc',
            'user_id' => 'Usuario',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $date1 = date("r", strtotime($request->datestart));
                $date2 = date("r", strtotime($request->dateend));

                $units = UsersUnits::find($id);

                if(isset($request->datestart))
                {
                    $units->datestart = $date1;
                    $units->datestart2 = $request->datestart;
                }
                if(isset($request->dateend))
                {
                    $units->dateend = $date2;
                    $units->dateend2 = $request->dateend;
                }
                if(isset($request->type))
                {
                    $units->type = $request->type;
                }
                if(isset($request->description))
                {
                    $units->description = $request->description;
                }
                if(isset($request->summary))
                {
                    $units->summary = $request->summary;
                }
                if(isset($request->attachment))
                {
                  $units->attachment = $request->attachment;
                }
                if(isset($request->codepayment ))
                {
                  $units->codepayment  = $request->codepayment;
                }
                if(isset($request->noticeamountpayment ))
                {
                  $units->noticeamountpayment  = $request->noticeamountpayment;
                }
                if(isset($request->noticedatepayment ))
                {
                  $units->noticedatepayment  = $request->noticedatepayment;
                }
                if(isset($request->noticedescpayment ))
                {
                  $units->noticedescpayment  = $request->noticedescpayment;
                }
                $units->user_id = $request->user_id;
                $units->save();
                return response()->json(['message' => 'UActualizado', 'units' => $units], 200);
            }
            else
            {
                return response()->json(['message'=>'Error al actualizar'], 400);
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
            $units = UsersUnits::find($id);
            $units->delete();
            return response()->json(['message' => 'Eliminado'], 200);
            
        }
        else
        {
            return response()->json(['message' => "Error al eliminar"], 400);
        }
    }
}
