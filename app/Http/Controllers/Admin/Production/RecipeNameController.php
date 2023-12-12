<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;

use App\Models\RecipeName;
use Illuminate\Http\Request;

/**
 * Class RecipeNameController
 * @package App\Http\Controllers
 */
class RecipeNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:recipeNames-list',  ['only' => ['index']]);
        $this->middleware('permission:recipeNames-view',  ['only' => ['show']]);
        $this->middleware('permission:recipeNames-create',['only' => ['create','store']]);
        $this->middleware('permission:recipeNames-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:recipeNames-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipeNames = RecipeName::get();

        return view('admin.production.recipe-name.index', compact('recipeNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipeName = new RecipeName();
        return view('admin.production.recipe-name.create', compact('recipeName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $recipeName = RecipeName::create($request->all());
        return redirect()->route('recipe-names.index')
            ->with('success', 'RecipeName created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipeName = RecipeName::find($id);

        return view('admin.production.recipe-name.show', compact('recipeName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipeName = RecipeName::find($id);

        return view('admin.production.recipe-name.edit', compact('recipeName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RecipeName $recipeName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeName $recipeName)
    {
        $recipeName->update($request->all());

        return redirect()->route('recipe-names.index')
            ->with('success', 'RecipeName updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $recipeName = RecipeName::find($id)->delete();

        return redirect()->route('recipe-names.index')
            ->with('success', 'RecipeName deleted successfully');
    }
}
