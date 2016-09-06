<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Word\WordRepository;

class AnswerController extends Controller
{
    protected $answerRepository;
    protected $wordRepository;

    public function __construct(AnswerRepository $answerRepository, WordRepository $wordRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->wordRepository = $wordRepository;
    }

    public function index()
    {
        $answers = $this->answerRepository->paginate(config('settings.limit'));

        return view('admin.answer.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $words = $this->wordRepository->getListWord();

        return view('admin.answer.create', compact('words'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateAnswerRequest $request)
    {
        $input = $request->only('word_id', 'content', 'is_correct');

        if ($this->answerRepository->create($input)) {
            return redirect()->route('admin.answer.index')->with('success', trans('answer.create_answer_successfully'));
        }

        return redirect()->route('admin.answer.index')->with('errors', trans('answer.create_answer_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $answer = $this->answerRepository->find($id);

        if (!$answer) {
            return redirect()->route('admin.answer.index')->with('errors', trans('answer.answer_not_found'));
        }

        return view('admin.answer.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $answer = $this->answerRepository->find($id);
        $words = $this->wordRepository->getListWord();

        if (!$answer) {
            return redirect()->route('admin.answer.index')->with('errors', trans('answer.answer_not_found'));
        }

        return view('admin.answer.edit', compact('answer', 'words'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateAnswerRequest $request)
    {
        $input = $request->only('word_id', 'content', 'is_correct');

        if ($this->answerRepository->update($input, $id)) {
            return redirect()->route('admin.answer.index')->with('success', trans('answer.update_answer_successfully'));
        }

        return redirect()->route('admin.answer.index')->with('errors', trans('answer.update_answer_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $answer = $this->answerRepository->find($id);

        if (!$answer) {
            return redirect()->route('admin.answer.index')->with('errors', trans('answer.answer_not_found'));
        }

        if ($answer->delete()) {
            return redirect()->route('admin.answer.index')->with('success', trans('answer.delete_answer_successfully'));
        }

        return redirect()->route('admin.answer.index')->with('errors', trans('answer.delete_answer_fail'));
    }

}
