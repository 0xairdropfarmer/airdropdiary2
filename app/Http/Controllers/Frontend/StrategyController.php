<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStrategyRequest;
use App\Http\Requests\StoreStrategyRequest;
use App\Http\Requests\UpdateStrategyRequest;
use App\Models\Strategy;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StrategyController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('strategy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $strategies = Strategy::with(['task', 'media'])->get();

        return view('frontend.strategies.index', compact('strategies'));
    }

    public function create()
    {
        abort_if(Gate::denies('strategy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.strategies.create', compact('tasks'));
    }

    public function store(StoreStrategyRequest $request)
    {
        $strategy = Strategy::create($request->all());

        if ($request->input('cover', false)) {
            $strategy->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $strategy->id]);
        }

        return redirect()->route('frontend.strategies.index');
    }

    public function edit(Strategy $strategy)
    {
        abort_if(Gate::denies('strategy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $strategy->load('task');

        return view('frontend.strategies.edit', compact('strategy', 'tasks'));
    }

    public function update(UpdateStrategyRequest $request, Strategy $strategy)
    {
        $strategy->update($request->all());

        if ($request->input('cover', false)) {
            if (! $strategy->cover || $request->input('cover') !== $strategy->cover->file_name) {
                if ($strategy->cover) {
                    $strategy->cover->delete();
                }
                $strategy->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
            }
        } elseif ($strategy->cover) {
            $strategy->cover->delete();
        }

        return redirect()->route('frontend.strategies.index');
    }

    public function show(Strategy $strategy)
    {
        abort_if(Gate::denies('strategy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $strategy->load('task');

        return view('frontend.strategies.show', compact('strategy'));
    }

    public function destroy(Strategy $strategy)
    {
        abort_if(Gate::denies('strategy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $strategy->delete();

        return back();
    }

    public function massDestroy(MassDestroyStrategyRequest $request)
    {
        $strategies = Strategy::find(request('ids'));

        foreach ($strategies as $strategy) {
            $strategy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('strategy_create') && Gate::denies('strategy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Strategy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
