<?php

namespace App\Http\Controllers\Profile;

use App\Lists;
use App\Tasks;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $countLists = Lists::where('user_id', auth()->user()->id)->count();
        $countUsers = User::count();
        $countTags = Tasks::join('todo_lists', 'todo_tasks.todo_list_id', '=', 'todo_lists.id')
            ->where('is_done', 0)
            ->where('user_id', auth()->user()->id)
            ->count();

        return view('profile.dashboard', [
            'countLists' => $countLists,
            'countUsers' => $countUsers,
            'countTags' => $countTags
        ]);
    }

    public function search(Request $request)
    {
        $lists = Lists::where('user_id', auth()->user()->id)->get();
        if ($request->ajax()) {
            $text = $request->input('text');
            $places = Tasks::where('title', 'Like', "%$text%")
                ->select('title', 'todo_list_id', 'is_done', 'created_at')
                ->get();

            return response()->json($places);
        }
        if ($request->lists) {
            $tasksSearch = $request->lists;
            $text = $request->input('text-search');
            $searchResult = Tasks::join('todo_lists', 'todo_tasks.todo_list_id', '=', 'todo_lists.id')
                ->select('todo_tasks.id', 'todo_tasks.title', 'todo_tasks.is_done', 'todo_tasks.created_at', 'todo_tasks.updated_at', 'todo_lists.id as list_id', 'todo_lists.title as list_title', 'todo_lists.description as list_description', 'todo_lists.user_id')
                ->where('todo_tasks.title', 'Like', "%$text%")
                ->whereIn('todo_tasks.todo_list_id', $tasksSearch)
                ->get();

            return view('profile.search', [
                'searchResult' => $searchResult,
                'text' => $text,
                'lists' => $lists,
                'tasksSearch' => $tasksSearch
            ]);
        }
        $tasksSearch = [];
        $text = $request->input('text-search');
        $searchResult = Tasks::join('todo_lists', 'todo_tasks.todo_list_id', '=', 'todo_lists.id')
            ->select('todo_tasks.id', 'todo_tasks.title', 'todo_tasks.is_done', 'todo_tasks.created_at', 'todo_tasks.updated_at', 'todo_lists.id as list_id', 'todo_lists.title as list_title', 'todo_lists.description as list_description', 'todo_lists.user_id')
            ->where('todo_tasks.title', 'Like', "%$text%")
            ->where('todo_lists.user_id', auth()->user()->id)
            ->paginate(12);

        return view('profile.search', [
            'searchResult' => $searchResult,
            'text' => $text,
            'lists' => $lists,
            'tasksSearch' => $tasksSearch
        ]);

    }
}
