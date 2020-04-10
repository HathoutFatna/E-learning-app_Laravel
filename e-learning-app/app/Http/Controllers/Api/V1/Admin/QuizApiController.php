<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Http\Resources\Admin\QuizResource;
use App\Quiz;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quiz_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuizResource(Quiz::with(['questions', 'cours'])->get());
    }

    public function store(StoreQuizRequest $request)
    {
        $quiz = Quiz::create($request->all());
        $quiz->questions()->sync($request->input('questions', []));

        return (new QuizResource($quiz))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Quiz $quiz)
    {
        abort_if(Gate::denies('quiz_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuizResource($quiz->load(['questions', 'cours']));
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->all());
        $quiz->questions()->sync($request->input('questions', []));

        return (new QuizResource($quiz))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Quiz $quiz)
    {
        abort_if(Gate::denies('quiz_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quiz->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
