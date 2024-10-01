<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;

class TaskController extends Controller {
    public function __construct() {
        $this->authorizeResource(Task::class);
    }

    public function index() {
        $tasks = Task::with('category' , 'user')->paginate(5);
        $categories = Category::has('tasks')->get();
        return Inertia::render('Task/Tasks',[
            'tasks' => $tasks ,
            'categories' => $categories ,
        ]);
    }

    public function getTasksByCategory(Category $category) {
        $categories = Category::has('tasks')->get();
        $tasks = $category->tasks()->with('category' , 'user')->paginate(5);
        return Inertia::render('Task/Tasks',[
            'tasks' => $tasks ,
            'categories' => $categories ,
        ]);
    }

    public function getTasksOrderedBy($column , $direction) {
        $categories = Category::has('tasks')->get();
        $tasks = Task::with('category' , 'user')->orderBy($column , $direction)->paginate(5);
        return Inertia::render('Task/Tasks',[
            'tasks' => $tasks ,
            'categories' => $categories ,
        ]);
    }

    public function create() {
        $categories = Category::all();
        return Inertia::render('Task/CreateTask',[
            'categories' => $categories ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request) {
        if ($request->validated()) {
            Task::create([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
            ]);
            return redirect()->route('home')->with([
                'message' => 'Task Added Successfully',
                'class' => 'alert alert-success',
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task) {
        $categories = Category::all();
        return Inertia::render('Task/EditTask',[
            'categories' => $categories ,
            'task' => $task ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task) {
        if($request->validated()){
            $task->update([
                'title'=> $request->title,
                'body'=> $request->body,
                'category_id'=> $request->category_id,
                'done'=> $request->done,
            ]);
        }

        return redirect()->route('home')->with([
            'message'=> 'Task Updated Successfully',
            'class'=> 'alert alert-success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        if(Auth::user()->isAdmin){
            $task->user->notify(new TaskNotification($task)) ;
        }
        return redirect()->route('home')->with([
            'message'=> 'Task Deleted Successfully',
            'class'=> 'alert alert-success'
        ]);
    }

    public function getTasksByTerm(Request $request) {
        $tasks = Task::with('category' , 'user')
        ->where('title' , 'like' , '%'.$request->term.'%')
        ->orWhere('body' , 'like' , '%'.$request->term.'%')
        ->orWhere('id' , 'like' , '%'.$request->term.'%')->paginate(5);
        $categories = Category::all();
        return Inertia::render('Task/Tasks',[
            'categories' => $categories ,
            'tasks' => $tasks ,
        ]);
    }

}
