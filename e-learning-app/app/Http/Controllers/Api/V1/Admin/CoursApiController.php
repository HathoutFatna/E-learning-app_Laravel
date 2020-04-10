<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Cour;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use App\Http\Resources\Admin\CourResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourResource(Cour::with(['enseignants'])->get());
    }

    public function store(StoreCourRequest $request)
    {
        $cour = Cour::create($request->all());
        $cour->enseignants()->sync($request->input('enseignants', []));

        return (new CourResource($cour))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cour $cour)
    {
        abort_if(Gate::denies('cour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourResource($cour->load(['enseignants']));
    }

    public function update(UpdateCourRequest $request, Cour $cour)
    {
        $cour->update($request->all());
        $cour->enseignants()->sync($request->input('enseignants', []));

        return (new CourResource($cour))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cour $cour)
    {
        abort_if(Gate::denies('cour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cour->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
