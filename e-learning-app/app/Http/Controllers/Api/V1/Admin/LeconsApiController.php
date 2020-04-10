<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLeconRequest;
use App\Http\Requests\UpdateLeconRequest;
use App\Http\Resources\Admin\LeconResource;
use App\Lecon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeconsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lecon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeconResource(Lecon::with(['chapitre'])->get());
    }

    public function store(StoreLeconRequest $request)
    {
        $lecon = Lecon::create($request->all());

        if ($request->input('images', false)) {
            $lecon->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
        }

        if ($request->input('fichiers', false)) {
            $lecon->addMedia(storage_path('tmp/uploads/' . $request->input('fichiers')))->toMediaCollection('fichiers');
        }

        return (new LeconResource($lecon))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lecon $lecon)
    {
        abort_if(Gate::denies('lecon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LeconResource($lecon->load(['chapitre']));
    }

    public function update(UpdateLeconRequest $request, Lecon $lecon)
    {
        $lecon->update($request->all());

        if ($request->input('images', false)) {
            if (!$lecon->images || $request->input('images') !== $lecon->images->file_name) {
                $lecon->addMedia(storage_path('tmp/uploads/' . $request->input('images')))->toMediaCollection('images');
            }
        } elseif ($lecon->images) {
            $lecon->images->delete();
        }

        if ($request->input('fichiers', false)) {
            if (!$lecon->fichiers || $request->input('fichiers') !== $lecon->fichiers->file_name) {
                $lecon->addMedia(storage_path('tmp/uploads/' . $request->input('fichiers')))->toMediaCollection('fichiers');
            }
        } elseif ($lecon->fichiers) {
            $lecon->fichiers->delete();
        }

        return (new LeconResource($lecon))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lecon $lecon)
    {
        abort_if(Gate::denies('lecon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecon->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
