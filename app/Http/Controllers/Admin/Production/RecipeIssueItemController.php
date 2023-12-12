<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;

use App\Models\RecipeIssueItem;
use Illuminate\Http\Request;

/**
 * Class RecipeIssueItemController
 * @package App\Http\Controllers
 */
class RecipeIssueItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:recipeIssueItems-list',  ['only' => ['index']]);
        $this->middleware('permission:recipeIssueItems-view',  ['only' => ['show']]);
        $this->middleware('permission:recipeIssueItems-create',['only' => ['create','store']]);
        $this->middleware('permission:recipeIssueItems-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:recipeIssueItems-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipeIssueItems = RecipeIssueItem::get();

        return view('admin.production.recipe-issue-item.index', compact('recipeIssueItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipeIssueItem = new RecipeIssueItem();
        return view('admin.production.recipe-issue-item.create', compact('recipeIssueItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $recipeIssueItem = RecipeIssueItem::create($request->all());
        return redirect()->back()
            ->with('success', 'Recipe Issue Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipeIssueItem = RecipeIssueItem::find($id);

        return view('admin.production.recipe-issue-item.show', compact('recipeIssueItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipeIssueItem = RecipeIssueItem::find($id);

        return view('admin.production.recipe-issue-item.edit', compact('recipeIssueItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RecipeIssueItem $recipeIssueItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeIssueItem $recipeIssueItem)
    {
        $recipeIssueItem->update($request->all());

        return redirect()->back()
            ->with('success', 'Recipe Issue Item updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $recipeIssueItem = RecipeIssueItem::find($id)->delete();

        return redirect()->back()
            ->with('success', 'Recipe Issue Item deleted successfully');
    }
}
