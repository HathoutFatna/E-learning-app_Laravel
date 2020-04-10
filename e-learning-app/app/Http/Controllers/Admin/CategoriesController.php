<?php

namespace App\Http\Controllers\admin;


use App\category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChapitreRequest;
use App\Http\Requests\StoreChapitreRequest;
use App\Http\Requests\UpdateChapitreRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CategoriesController extends Controller
{
    public function index(Request $request)
    {
       $categories = category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {

        return view('admin.categories.create');
    }

    public function store(Request $request){
        $category = new category();

        $category->nom = $request->input('nom');
        $category->save(); //persist the data

       // $category = category::create($request->all()) ;

        return redirect()->route('admin.categories.index');
    }

    public function edit(category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }
    public function update(Request $request, category $category)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}
