<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of Categories.
     *
     * @return View
     */
    public function index(): View
    {

        return view('category.index', [
            'categories' => Category::withCount('posts')->orderby('name', 'asc')->get()
        ]);

    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('category.create');

    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        // store category
        Category::create($request->all(['name']));

        // message success
        session()->flash('success', 'new category is created successfully');

        // redirect to list category
        return redirect()->route('category.index');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category $category
     * @return View
     */
    public function show(Category $category): View
    {

        return view('category.show', compact('category'));

    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category $category
     * @return View
     */
    public function edit(Category $category): View
    {

        return view('category.edit', compact('category'));

    }

    /**
     * Update the specified category in storage.
     *
     * @param   CategoryUpdateRequest $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        // check if is not uncategorized category
        if ($this->uncategorized($category)) {
            return $this->uncategorizedReturn();
        }

        // update category name
        $category->update($request->all(['name']));

        // message success
        session()->flash('success', 'name of category is updated successfully');

        // redirect to list category
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        // check if is not uncategorized category
        if ($this->uncategorized($category)) {
            return $this->uncategorizedReturn();
        }

        // update belong post to uncategorized
        $this->updatePosts($category);

        // delete category
        $category->delete();

        // message success
        session()->flash('success', 'The Category is deleted successfully');

        // redirect to list category
        return redirect()->route('category.index');
    }

    private function uncategorized(Category $category)
    {
        return $category->name === 'uncategorized';
    }

    /**
     * return warning message
     *
     * @return RedirectResponse
     */
    private function uncategorizedReturn()
    {
        session()->flash('warning', 'We cannot update this category');
        return redirect()->route('category.index');
    }

    /**
     * update belong posts to uncategorized id
     *
     * @param Category $category
     */
    private function updatePosts(Category $category)
    {
        // get uncategorized id
        $uncategorized = Category::where('name', 'uncategorized')->first();

        // update belong posts to uncategorized id
        Post::where('category_id', $category->id)
            ->update([
                'category_id' => $uncategorized->id
            ]);
    }
}
