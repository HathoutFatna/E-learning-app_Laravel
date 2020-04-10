<?php

namespace App\Http\Requests;

use App\Chapitre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChapitreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('chapitre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:chapitres,id',
        ];
    }
}
