<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecurringActivityRequest;
use App\Http\Requests\StoreRecurringActivityRequest;
use App\Http\Requests\UpdateRecurringActivityRequest;
use App\Models\RecurringActivity;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecurringActivityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recurring_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurringActivities = RecurringActivity::with(['user', 'task'])->get();

        return view('frontend.recurringActivities.index', compact('recurringActivities'));
    }

    public function create()
    {
        abort_if(Gate::denies('recurring_activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.recurringActivities.create', compact('tasks', 'users'));
    }

    public function store(StoreRecurringActivityRequest $request)
    {
        $recurringActivity = RecurringActivity::create($request->all());

        return redirect()->route('frontend.recurring-activities.index');
    }

    public function edit(RecurringActivity $recurringActivity)
    {
        abort_if(Gate::denies('recurring_activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $recurringActivity->load('user', 'task');

        return view('frontend.recurringActivities.edit', compact('recurringActivity', 'tasks', 'users'));
    }

    public function update(UpdateRecurringActivityRequest $request, RecurringActivity $recurringActivity)
    {
        $recurringActivity->update($request->all());

        return redirect()->route('frontend.recurring-activities.index');
    }

    public function show(RecurringActivity $recurringActivity)
    {
        abort_if(Gate::denies('recurring_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurringActivity->load('user', 'task');

        return view('frontend.recurringActivities.show', compact('recurringActivity'));
    }

    public function destroy(RecurringActivity $recurringActivity)
    {
        abort_if(Gate::denies('recurring_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurringActivity->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecurringActivityRequest $request)
    {
        $recurringActivities = RecurringActivity::find(request('ids'));

        foreach ($recurringActivities as $recurringActivity) {
            $recurringActivity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
