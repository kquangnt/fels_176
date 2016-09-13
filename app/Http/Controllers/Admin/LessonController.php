<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\User\UserRepository;

class LessonController extends Controller
{
    protected $lessonRepository;
    protected $categoryRepository;
    protected $userRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $lessons = $this->lessonRepository->paginate(config('settings.limit'));

        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        $users = $this->userRepository->lists('name', 'id');

        return view('admin.lesson.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateLessonRequest $request)
    {
        $input = $request->only('user_id', 'category_id');

        if ($this->lessonRepository->create($input)) {
            return redirect()->route('admin.lesson.index')->with('success', trans('lesson.create_lesson_successfully'));
        }

        return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.create_lesson_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $lesson = $this->lessonRepository->find($id);

        if (!$lesson) {
            return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.lesson_not_found'));
        }

        return view('admin.lesson.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $lesson = $this->lessonRepository->find($id);
        $categories = $this->categoryRepository->lists('name', 'id');
        $users = $this->userRepository->lists('name', 'id');

        if (!$lesson) {
            return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.lesson_not_found'));
        }

        return view('admin.lesson.edit', compact('lesson', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateLessonRequest $request)
    {
        $input = $request->only('user_id', 'category_id');

        if ($this->lessonRepository->update($input, $id)) {
            return redirect()->route('admin.lesson.index')->with('success', trans('lesson.update_lesson_successfully'));
        }

        return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.update_lesson_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $lesson = $this->lessonRepository->find($id);

        if (!$lesson) {
            return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.lesson_not_found'));
        }

        if ($lesson->delete()) {
            return redirect()->route('admin.lesson.index')->with('success', trans('lesson.delete_lesson_successfully'));
        }

        return redirect()->route('admin.lesson.index')->with('errors', trans('lesson.delete_lesson_fail'));
    }
}
