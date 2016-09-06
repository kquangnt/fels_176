<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;

class WordController extends Controller
{
    protected $wordRepository;
    protected $categoryRepository;

    public function __construct(WordRepository $wordRepository, CategoryRepository $categoryRepository)
    {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $words = $this->wordRepository->paginate(config('settings.limit'));

        return view('admin.word.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getListCategory();

        return view('admin.word.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateWordRequest $request)
    {
        $input = $request->only('content', 'category_id');

        if ($this->wordRepository->create($input)) {
            return redirect()->route('admin.word.index')->with('success', trans('word.create_word_successfully'));
        }

        return redirect()->route('admin.word.index')->with('errors', trans('word.create_word_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $word = $this->wordRepository->find($id);

        if (!$word) {
            return redirect()->route('admin.word.index')->with('errors', trans('word.word_not_found'));
        }

        return view('admin.word.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $word = $this->wordRepository->find($id);
        $categories = $this->categoryRepository->getListCategory();

        if (!$word) {
            return redirect()->route('admin.word.index')->with('errors', trans('word.word_not_found'));
        }

        return view('admin.word.edit', compact('word', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateWordRequest $request)
    {
        $input = $request->only('content', 'category_id');

        if ($this->wordRepository->update($input, $id)) {
            return redirect()->route('admin.word.index')->with('success', trans('word.update_word_successfully'));
        }

        return redirect()->route('admin.word.index')->with('errors', trans('word.update_word_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $word = $this->wordRepository->find($id);

        if (!$word) {
            return redirect()->route('admin.word.index')->with('errors', trans('word.word_not_found'));
        }

        if ($word->delete()) {
            return redirect()->route('admin.word.index')->with('success', trans('word.delete_word_successfully'));
        }

        return redirect()->route('admin.word.index')->with('errors', trans('word.delete_word_fail'));
    }
}
