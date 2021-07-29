<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    //protegiendo la ruta mediante el contructor
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('home',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        //almacena los datos
    public function store(Request $request)
    {
        $this->validate($request,[
            //validacion de backend
            'title' => 'required | string |max:255',
            'description' => 'nullable | string |',
            'completed' => 'nullable',
        ]);

        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');

        if ($request->has('completed')){
            $task->completed = true;
        }
        $task->user_id = Auth::user()->id;

        $task->save();

        return back()->with('success','Tarea Creada');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$task){
            abort(404);
        }
        return view('delete_task',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$task){
            abort(404);
        }
        return view('edit_task',compact('task'));
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
        $this->validate($request,[
            //validacion de backend
            'title' => 'required | string |max:255',
            'description' => 'nullable | string |',
            'completed' => 'nullable',
        ]);

        $task = Task::find($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');

        if ($request->has('completed')){
            $task->completed = true;
        }
        else{
            $task->completed = false;
        }
        $task->user_id = Auth::user()->id;

        $task->save();

        return back()->with('success','Tarea Actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Tarea eliminada');
    }
}
