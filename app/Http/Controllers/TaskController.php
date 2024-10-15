<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //This is the task controller Method

        $tasks = Task::all();
        return  response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Storing the data which is comming from api

        $validated= $request->validate([
            'title'=> 'required|string|max:255',
            'description'=> 'nullable|string',
            'is_completed'=> 'nullable|boolean'
        ]);


        $task = Task::create($validated);


        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $task = Task::find($id);

        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $task =Task::find($id);

        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'title'=> 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed'=> 'nullable|boolean'
        ]);


        $task->update($validatedData);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        //this is the method  to delete the data

        $task= Task::find($id);

        if(!$task){
            return response()->json(['message'=> 'Task not found'], 404);

        }

        $task->delete();

        return response()->json(['messsgae'=> 'Task deleted successfully']);
    }
}
