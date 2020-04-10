<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Chapitre;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapitreRequest;
use App\Http\Requests\UpdateChapitreRequest;
use App\Http\Resources\Admin\ChapitreResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChapitresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('chapitre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChapitreResource(Chapitre::with(['cours'])->get());
    }

    public function store(StoreChapitreRequest $request)
    {
        $chapitre = Chapitre::create($request->all());

        return (new ChapitreResource($chapitre))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Chapitre $chapitre)
    {
        abort_if(Gate::denies('chapitre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChapitreResource($chapitre->load(['cours']));
    }

    public function update(UpdateChapitreRequest $request, Chapitre $chapitre)
    {
        $chapitre->update($request->all());

        return (new ChapitreResource($chapitre))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Chapitre $chapitre)
    {
        abort_if(Gate::denies('chapitre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapitre->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
