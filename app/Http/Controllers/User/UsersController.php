<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Hash;
use App\Repositories\UserShow\UserShowRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Relationship\RelationshipRepository;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $userRepository;
    protected $lessonRepository;
    protected $answerRepository;
    protected $resultRepository;
    protected $userShowRepository;
    protected $relationshipRepository;

    public function __construct(
        UserRepository $userRepository,
        UserShowRepository $userShowRepository,
        LessonRepository $lessonRepository,
        AnswerRepository $answerRepository,
        ResultRepository $resultRepository,
        RelationshipRepository $relationshipRepository
    ) {
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
        $this->userShowRepository = $userShowRepository;
        $this->relationshipRepository = $relationshipRepository;
        parent::__construct();
    }

    public function index()
    {
        $sumLearnedWords = $this->userRepository->sumLearnedWords($this->lessonRepository, $this->resultRepository, $this->answerRepository);
        $users = $this->userShowRepository->getLessonsNotFollowedUser($this->relationshipRepository);

        return view('user.user_show', compact('sumLearnedWords', 'users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $userDetail = $this->userShowRepository->find($id);

        return view('user.user_detail', compact('userDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if ($id != $this->currentUser->id) {
            return view('user.home')->withErrors(trans('message.not_permission'));
        }

        return view('user.profile', ['user' => $this->currentUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->only(['email', 'name', 'password', 'avatar']);
            $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            return view('home')->withError(trans('message.update_error'));
        }

        return view('home')->withSuccess(trans('message.edit_user_successfully'));
    }

}
