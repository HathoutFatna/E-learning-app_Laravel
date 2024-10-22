<?php

namespace App\Http\Requests;

use App\Quiz;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQuizRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('quiz_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:quizzes,id',
        ];
    }
}
