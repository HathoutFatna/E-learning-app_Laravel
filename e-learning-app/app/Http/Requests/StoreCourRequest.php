<?php

namespace App\Http\Requests;

use App\Cour;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCourRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'enseignants.*' => [
                'integer',
            ],
            'enseignants'   => [
                'array',
            ],
            'titre'         => [
                'required',
            ],
        ];
    }
}
