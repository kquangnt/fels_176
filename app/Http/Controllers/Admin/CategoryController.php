<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->paginate(config('settings.limit'));

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.category.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->only('name', 'description');

        if ($this->categoryRepository->create($input)) {
            return redirect()->route('admin.category.index')->with('success', trans('category.create_category_successfully'));
        }

        return redirect()->route('admin.category.index')->with('errors', trans('category.create_category_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()->route('admin.category.index')->with('errors', trans('category.category_not_found'));
        }

        return view('admin.category.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()->route('admin.category.index')->with('errors', trans('category.category_not_found'));
        }

        return view('admin.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $input = $request->only('name', 'description');

        if ($this->categoryRepository->update($input, $id)) {
            return redirect()->route('admin.category.index')->with('success', trans('category.update_category_successfully'));
        }

        return redirect()->route('admin.category.index')->with('errors', trans('category.update_category_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            return redirect()->route('admin.category.index')->with('errors', trans('category.category_not_found'));
        }

        if ($category->delete()) {
            return redirect()->route('admin.category.index')->with('success', trans('category.delete_category_successfully'));
        }

        return redirect()->route('admin.category.index')->with('errors', trans('category.delete_category_fail'));
    }
}
