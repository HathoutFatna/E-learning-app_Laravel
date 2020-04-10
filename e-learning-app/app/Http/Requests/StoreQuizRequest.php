<?php

namespace App\Http\Requests;

use App\Quiz;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreQuizRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('quiz_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'questions.*' => [
                'integer',
            ],
            'questions'   => [
                'required',
                'array',
            ],
            'titre'       => [
                'required',
            ],
        ];
    }
}
