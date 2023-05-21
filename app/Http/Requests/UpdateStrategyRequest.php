<?php

namespace App\Http\Requests;

use App\Models\Strategy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStrategyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('strategy_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'tasks.*' => [
                'integer',
            ],
            'tasks' => [
                'array',
            ],
            'expire_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}