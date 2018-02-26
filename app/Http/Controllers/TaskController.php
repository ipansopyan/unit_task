<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index()
    {
        $data['tasks'] = Task::all();
        
        if (!is_null('id') && request('action')  == 'edit' ) {
            $data['editTable'] = Task::find(1);
        }

        return view('tasks/index',$data);
    }
    public function store(Request $request)
    {   
        request()->validate([
            'name'          =>  'required',
            'description'   =>  'required',
            ]);

        Task::create(request()->only('name','description'));
        return redirect()->route('tasks');
    }
    public function update($id)
    {   
        $taskData = request()->validate([
        'name'        => 'required|max:255',
        'description' => 'required|max:255',
        ]);
        $task = Task::find($id);
        $task->update($taskData);

        return redirect()->route('tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks');
    }
}
