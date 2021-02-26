<?php

namespace App\Http\Controllers\Profile;

use App\Tasks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:250'
        ]);

        $newTask = new Tasks();
        $newTask->title = $request->title;
        $newTask->todo_list_id = $request->list_id;
        $newTask->save();

        $html = view('profile.components.task', ['task' => $newTask])->render();
        $data = [
            'status' => 'success',
            'html' => $html
        ];

        return response($data, 200);
    }

    public function done(Request $request)
    {
        if (isset($request->id)) {
            $task = Tasks::find($request->id);
            $task->is_done = $request->isDone;
            $task->save();

            return response(['status' => 'success'], 200);
        }
    }

    public function remove(Request $request)
    {
        $task = Tasks::whereId($request->id)->firstOrFail();
        $task->delete();

        return response(['status' => 'success']);
    }
}
