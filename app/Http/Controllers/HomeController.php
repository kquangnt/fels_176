<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;

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

    public function __construct(UserRepository $userRepository, LessonRepository $lessonRepository, AnswerRepository $answerRepository, ResultRepository $resultRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $sumLearnedWords = $this->userRepository->sumLearnedWords($this->lessonRepository, $this->resultRepository, $this->answerRepository);
        } catch (Exception $e) {
            return view('user.home')->withError($e->getMessage());
        }
        return view('user.home', compact('sumLearnedWords'));
    }
}
