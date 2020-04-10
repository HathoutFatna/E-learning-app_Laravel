<?php

namespace App\Http\Controllers\Admin;

use App\Chapitre;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLeconRequest;
use App\Http\Requests\StoreLeconRequest;
use App\Http\Requests\UpdateLeconRequest;
use App\Lecon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LeconsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lecon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lecons = Lecon::whereIn('chapitre_id', Chapitre::ofTeacher()->pluck('id'));
        if ($request->input('chapitre_id')){
            $lecons = $lecons->where('chapitre_id', $request->input('chapitre_id'));
        }
        $lecons = $lecons->get();

        return view('admin.lecons.index', compact('lecons'));
    }

    public function create()
    {
        abort_if(Gate::denies('lecon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapitres = Chapitre::OfTeacher()->get()->pluck('titre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lecons.create', compact('chapitres'));
    }

    public function store(StoreLeconRequest $request)
    {
        $lecon = Lecon::create($request->all() +
            ['position' => Lecon::where('chapitre_id', $request->chapitre_id)->max('position') + 1]) ;

        foreach ($request->input('images', []) as $file) {
            $lecon->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        foreach ($request->input('fichiers', []) as $file) {
            $lecon->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('fichiers');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lecon->id]);
        }

        return redirect()->route('admin.lecons.index', ['chapitre_id' => $request->chapitre_id]);
    }

    public function edit(Lecon $lecon)
    {
        abort_if(Gate::denies('lecon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapitres = Chapitre::OfTeacher()->get()->pluck('titre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lecon->load('chapitre');

        return view('admin.lecons.edit', compact('chapitres', 'lecon'));
    }

    public function update(UpdateLeconRequest $request, Lecon $lecon)
    {
        $lecon->update($request->all());

        if (count($lecon->images) > 0) {
            foreach ($lecon->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $lecon->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lecon->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        if (count($lecon->fichiers) > 0) {
            foreach ($lecon->fichiers as $media) {
                if (!in_array($media->file_name, $request->input('fichiers', []))) {
                    $media->delete();
                }
            }
        }

        $media = $lecon->fichiers->pluck('file_name')->toArray();

        foreach ($request->input('fichiers', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lecon->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('fichiers');
            }
        }

        return redirect()->route('admin.lecons.index');
    }

    public function show(Lecon $lecon)
    {
        abort_if(Gate::denies('lecon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecon->load('chapitre');

        return view('admin.lecons.show', compact('lecon'));
    }

    public function destroy(Lecon $lecon)
    {
        abort_if(Gate::denies('lecon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecon->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeconRequest $request)
    {
        Lecon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lecon_create') && Gate::denies('lecon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Lecon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
