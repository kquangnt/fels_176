<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Word\WordRepository;
use App\Repositories\Relationship\RelationshipRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRepository;
    protected $lessonRepository;
    protected $answerRepository;
    protected $resultRepository;
    protected $wordRepository;
    protected $relationshipRepository;

    public function __construct(
        UserRepository $userRepository,
        LessonRepository $lessonRepository,
        AnswerRepository $answerRepository,
        ResultRepository $resultRepository,
        WordRepository $wordRepository,
        RelationshipRepository $relationshipRepository
    ) {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
        $this->wordRepository = $wordRepository;
        $this->relationshipRepository = $relationshipRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumLearnedWords = $this->userRepository->sumLearnedWords($this->lessonRepository, $this->resultRepository, $this->answerRepository);
        $lessons = $this->lessonRepository->getLessonsFollowedUser($this->relationshipRepository);
        $listLearnedWord = $this->wordRepository->getListLearnedWord($this->resultRepository, $this->lessonRepository, $this->answerRepository);

        return view('user.home', compact('sumLearnedWords', 'lessons', 'listLearnedWord'));
    }
}
