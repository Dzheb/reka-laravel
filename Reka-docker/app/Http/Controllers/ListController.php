<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ListRequest;
use App\Models\CheckList;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function saveNewList(ListRequest $req)
    {
            $list = new CheckList();
            $list->name = $req->input('name');
            $list->uid = Auth::user()->id;
            $list->save();
            $data = CheckList::orderBy('id')->latest()->paginate(2);
            Session::flash('success', 'Список был добавлен');
            return redirect()->route('lists', compact('data'));
    }
    public function updateListSubmit($id, ListRequest $req)
    {
        $list = CheckList::find($id);
        $list->name = $req->input('name');
        return redirect()->route('list-data-one', $id)->with('success', 'Информация была обновлена');
    }
    public function allLists()
    {
        $user = Auth::user();
        $data = CheckList::orderBy('id')->latest()->paginate(2);
        return view('lists', compact('data'));
    }
    public function showOneList($id)
    {
        $filter = request()->all();
        $tasks = Task::where('lid', $id)->filterBy(request()->all())->get();
        $tags = Tag::all();
        return view('one-list', ['data' => CheckList::find($id), 'tasks' => $tasks, 'tags' => $tags, 'user' => auth()->user(),'filter'=>$filter]);
    }

    public function deleteList($id)
    {
        CheckList::find($id)->delete();
        Task::where('lid', $id)->delete();
        $data = CheckList::orderBy('id')->latest()->paginate(2);
        Session::flash('success', 'Список был удален');
        return redirect()->route('lists',compact('data'));
    }
}
