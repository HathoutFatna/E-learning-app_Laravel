<?php

namespace App\Http\Requests;

use App\Lecon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLeconRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lecon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
