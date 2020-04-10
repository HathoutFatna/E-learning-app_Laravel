<?php

namespace App\Http\Requests;

use App\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'texte'    => [
                'required',
            ],
            'score'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'option_1' => [
                'min:0',
                'max:300',
                'required',
            ],
            'option_2' => [
                'min:0',
                'max:300',
                'required',
            ],
            'option_3' => [
                'min:0',
                'max:300',
            ],
            'option_4' => [
                'min:0',
                'max:300',
            ],
        ];
    }
}
