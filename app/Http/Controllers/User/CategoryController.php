<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Word\WordRepository;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $categoryRepository;
    protected $lessonRepository;
    protected $answerRepository;
    protected $resultRepository;
    protected $wordRepository;

    public function __construct(CategoryRepository $categoryRepository, LessonRepository $lessonRepository, AnswerRepository $answerRepository, ResultRepository $resultRepository, WordRepository $wordRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
        $this->wordRepository = $wordRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->paginate(config('settings.limit'));
        $listLearnedWord = $this->wordRepository->getListLearnedWord($this->resultRepository, $this->lessonRepository, $this->answerRepository);

        return view('user.category', compact('categories', 'listLearnedWord'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
