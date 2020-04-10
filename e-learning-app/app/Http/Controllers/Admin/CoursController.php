<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Cour;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourRequest;
use App\Http\Requests\StoreCourRequest;
use App\Http\Requests\UpdateCourRequest;
use App\User;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploadingTrait;


class CoursController extends Controller
{
    use MediaUploadingTrait;
    public function index()
    {
        abort_if(Gate::denies('cour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cours = Cour::ofTeacher()->get();

        return view('admin.cours.index', compact('cours'));
    }

    public function create()
    {
        abort_if(Gate::denies('cour_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enseignants = User::whereHas('roles', function ($q) {$q->where('role_id', 2);})->pluck('name', 'id');

        $category = category::all()->pluck('nom', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cours.create', compact('enseignants', 'category'));
    }

    public function store(StoreCourRequest $request)
    {
        $cour = Cour::create($request->all());
        $teachers = \Auth::user()->isAdmin() ? $request->input('enseignants', []) : [\Auth::user()->id];
        $cour->enseignants()->sync($teachers);

        if ($request->input('image', false)) {
            $cour->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cour->id]);
        }


        return redirect()->route('admin.cours.index');
    }

    public function edit(Cour $cour)
    {
        abort_if(Gate::denies('cour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enseignants = User::whereHas('roles', function ($q) {$q->where('role_id', 2);})->pluck('name', 'id');

        $cour->load('enseignants','category');
        $category = category::all()->pluck('nom', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.cours.edit', compact('enseignants', 'cour', 'category'));
    }

    public function update(UpdateCourRequest $request, Cour $cour)
    {
        $cour->update($request->all());
        $teachers = \Auth::user()->isAdmin() ? $request->input('enseignants', []) : [\Auth::user()->id];
        $cour->enseignants()->sync($teachers);

        if ($request->input('image', false)) {
            if (!$cour->image || $request->input('image') !== $cour->image->file_name) {
                $cour->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($cour->image) {
            $cour->image->delete();
        }

        return redirect()->route('admin.cours.index');
    }

    public function show(Cour $cour)
    {
        abort_if(Gate::denies('cour_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cour->load('enseignants', 'coursChapitres', 'coursQuizzes', 'category');


        return view('admin.cours.show', compact('cour'));
    }

    public function destroy(Cour $cour)
    {
        abort_if(Gate::denies('cour_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cour->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourRequest $request)
    {
        Cour::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('cour_create') && Gate::denies('cour_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Cour();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
