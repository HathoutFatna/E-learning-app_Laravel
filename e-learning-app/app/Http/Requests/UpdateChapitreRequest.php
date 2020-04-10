<?php

namespace App\Http\Requests;

use App\Chapitre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateChapitreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('chapitre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'titre'    => [
                'required',
            ],
            'position' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
