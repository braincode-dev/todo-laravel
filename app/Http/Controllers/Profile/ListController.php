<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use App\Lists;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $lists = Lists::where('user_id', $userId)
            ->paginate(4);

        return view('profile.lists.index', [
            'lists' => $lists
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4|max:250',
            'description' => 'required|min:4|max:250',
        ]);

        $newList = new Lists();
        $newList->user_id = $request->user_id;
        $newList->title = $request->title;
        $newList->description = $request->description;
        $save = $newList->save();

        if ($save) {
            $html = view('profile.components.list', ['list' => $newList])->render();
            $data = [
                'status' => 'success',
                'message' => 'Ваш список успішно створено!',
                'html' => $html
            ];
            return response($data, 200);
        }
    }

    public function list($id)
    {
        $list = Lists::whereId($id)->firstOrFail();
        $tasks = Tasks::where('todo_list_id', $id)
            ->orderBy('is_done', 'desc')
            ->get();

        return view('profile.lists.one', [
            'list' => $list,
            'tasks' => $tasks,
        ]);
    }

    public function remove(Request $request)
    {
        $list = Lists::whereId($request->id)->firstOrFail();;
        $list->delete();
        $data = [
            'status' => 'success',
            'message' => 'Список та усі його завдання, було успішно видалено!',
            'count' => $list->count()
        ];
        return response($data, 200);
    }
}
