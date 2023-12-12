<?php

namespace App\Http\Controllers\Admin\Production;

use App\Http\Controllers\Controller;

use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class RecipeController
 * @package App\Http\Controllers
 */
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:recipes-list', ['only' => ['index']]);
        $this->middleware('permission:recipes-view', ['only' => ['show']]);
        $this->middleware('permission:recipes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:recipes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:recipes-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::with('recipeName', 'recipeIssueItems')->get();

        return view('admin.production.recipe.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipe = new Recipe();
        return view('admin.production.recipe.create', compact('recipe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = Recipe::create($request->all());
        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created successfully.');
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show($id): View
    {
        $recipe = Recipe::find($id);
        $recipe->load('recipeName', 'recipeIssueItems');
        return view('admin.production.recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);

        return view('admin.production.recipe.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update($request->all());

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe updated successfully');
    }

    public function post(Request $request, Recipe $recipe)
    {
        DB::transaction(function () use ($recipe) {
            $recipe->purchaseStockOut($recipe);
            $recipe->recipeStockIn($recipe);
            $recipe->update(['status' => 'Post']);
        });
        return redirect()->route('recipes.index')->with('success', 'Recipe Posted successfully.');
    }


//    public function post(Request $request, Recipe $recipe)
//    {
//        DB::transaction(function () use ($recipe) {
//            $recipe->saleStockIn($recipe);
//            $recipe->purchaseStockOut($recipe);
//            $recipe->update(['status' => 'Post']);
//        });
//        return redirect()->route('recipes.index')->with('success', 'Recipe Posted successfully.');
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Recipe $recipe
     * @return \Illuminate\Http\Response
     */
//    public function post(Request $request, Recipe $recipe)
//    {
//
//
//        $recipe->update($request->all());
//
//        return redirect()->route('recipes.index')
//            ->with('success', 'Recipe posted successfully');
//    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id)->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe deleted successfully');
    }
}
