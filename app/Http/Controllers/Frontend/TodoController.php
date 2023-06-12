<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTodoRequest;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Task;
use App\Models\Todo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('todo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $todos = Todo::with(['task'])->get();

        return view('frontend.todos.index', compact('todos'));
    }

    public function create()
    {
        abort_if(Gate::denies('todo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.todos.create', compact('tasks'));
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $todo->id]);
        }

        return redirect()->route('frontend.todos.index');
    }

    public function edit(Todo $todo)
    {
        abort_if(Gate::denies('todo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $todo->load('task');

        return view('frontend.todos.edit', compact('tasks', 'todo'));
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->all());

        return redirect()->route('frontend.todos.index');
    }

    public function show(Todo $todo)
    {
        abort_if(Gate::denies('todo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $todo->load('task');

        return view('frontend.todos.show', compact('todo'));
    }

    public function destroy(Todo $todo)
    {
        abort_if(Gate::denies('todo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $todo->delete();

        return back();
    }

    public function massDestroy(MassDestroyTodoRequest $request)
    {
        $todos = Todo::find(request('ids'));

        foreach ($todos as $todo) {
            $todo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('todo_create') && Gate::denies('todo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Todo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
