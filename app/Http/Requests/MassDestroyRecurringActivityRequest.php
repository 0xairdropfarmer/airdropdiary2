<?php

namespace App\Http\Requests;

use App\Models\RecurringActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRecurringActivityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('recurring_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:recurring_activities,id',
        ];
    }
}
