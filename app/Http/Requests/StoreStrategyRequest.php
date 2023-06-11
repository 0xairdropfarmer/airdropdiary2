<?php

namespace App\Http\Requests;

use App\Models\Strategy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStrategyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('strategy_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'expire_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
