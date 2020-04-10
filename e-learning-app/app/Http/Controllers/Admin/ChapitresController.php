<?php

namespace App\Http\Controllers\Admin;

use App\Chapitre;
use App\Cour;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChapitreRequest;
use App\Http\Requests\StoreChapitreRequest;
use App\Http\Requests\UpdateChapitreRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChapitresController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('chapitre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $chapitres = Chapitre::whereIn('cours_id', Cour::ofTeacher()->pluck('id'));
        if ($request->input('cours_id')){
            $chapitres = $chapitres->where('cours_id', $request->input('cours_id'));
        }
        $chapitres = $chapitres->get();

        return view('admin.chapitres.index', compact('chapitres'));
    }

    public function create()
    {
        abort_if(Gate::denies('chapitre_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cours = Cour::OfTeacher()->get()->pluck('titre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.chapitres.create', compact('cours'));
    }

    public function store(StoreChapitreRequest $request)
    {
        $chapitre = Chapitre::create($request->all() +
            ['position' => Chapitre::where('cours_id', $request->cours_id)->max('position') + 1]) ;

        return redirect()->route('admin.chapitres.index', ['cours_id' => $request->cours_id]);
    }

    public function edit(Chapitre $chapitre)
    {
        abort_if(Gate::denies('chapitre_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cours = Cour::OfTeacher()->get()->pluck('titre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $chapitre->load('cours');

        return view('admin.chapitres.edit', compact('cours', 'chapitre'));
    }

    public function update(UpdateChapitreRequest $request, Chapitre $chapitre)
    {
        $chapitre->update($request->all());

        return redirect()->route('admin.chapitres.index');
    }

    public function show(Chapitre $chapitre)
    {
        abort_if(Gate::denies('chapitre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapitre->load('cours', 'chapitreLecons');

        return view('admin.chapitres.show', compact('chapitre'));
    }

    public function destroy(Chapitre $chapitre)
    {
        abort_if(Gate::denies('chapitre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chapitre->delete();

        return back();
    }

    public function massDestroy(MassDestroyChapitreRequest $request)
    {
        Chapitre::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
