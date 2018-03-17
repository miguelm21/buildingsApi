<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Validator;
use App\Task;
use App\Units;

class ApiTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::join('units', 'tasks.unit_id', '=', 'units.id')->select('tasks.id as id', 'tasks.date as date', 'tasks.title as title', 'tasks.uf as uf', 'units.name as unit', 'tasks.status as status', 'tasks.description as description')->get();

        try
        {
            if(!isset($tasks))
            {
                return response()->json(['error' => 'No se encontraron tareas'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['tasks' => $tasks]);
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
            'title' => 'required',
            'uf' => 'required',
            'status' => 'required',
            'description' => 'required',
            'unit_id' => 'required'
        ]);
        $validator->setAttributeNames([
            'title' => 'Titulo',
            'uf' => 'Unidad Funcional',
            'status' => 'Estado',
            'description' => 'Descripcion',
            'unit_id' => 'Unidad',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $task = new Task;
                $task->date = date('Y-m-d');
                $task->title = $request->title;
                $task->uf = $request->uf;
                $task->status = $request->status;
                $task->description = $request->description;
                $task->unit_id = $request->unit_id;

                $task->save();
                return response()->json(['message' => 'Tarea Guardada', 'task' => $task], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al guardar la Tarea'], 400);
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
        $task = Task::findOrFail($id);

        try
        {
            if(!isset($task))
            {
                return response()->json(['error' => 'No se encontro ninguna tarea'], 401);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['error' => 'Ocurrio un error'], 500);
        }

        return response()->json(['task' => $task]);
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
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);
        $validator->setAttributeNames([
            'title' => 'Titulo',
            'status' => 'Estado',
            'description' => 'Descripcion',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $task = Task::find($id);
                $task->title = $request->title;
                $task->status = $request->status;
                $task->description = $request->description;

                $task->save();
                return response()->json(['message' => 'Tarea Actualizada', 'task' => $task], 200);
            }
            else
            {
                return response()->json(['message' => 'Error al actualizar la Tarea'], 400);
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
            $task = Task::find($id);
            $task->delete();
            return response()->json(['message' => 'Tarea eliminada'], 200);
            
        }
        else
        {
            return response()->json(['error' => "Error al eliminar la Tarea"], 400);
        }
    }

    public function updatestatus(Request $request, $id)
    {
        $validator =  Validator::make($request->all(),[ 
            'status' => 'required',
        ]);
        $validator->setAttributeNames([
            'status' => 'Estado',
        ]);
       
        if ($validator->fails()) 
        {
             return response()->json($validator->errors()->all(), 422);
        }
        else
        {
            if(isset($request))
            {
                $task = Task::find($id);
                $task->status = $request->status;

                $task->save();
                return response()->json(['message' => 'Estado Actualizado'], 200);
            }
            else
            {
                return response()->json(["message'=>'Error al actualizar el Estado"], 400);
            }
        }
    }
}
