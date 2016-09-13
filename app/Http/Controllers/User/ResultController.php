<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Word\WordRepository;
use App\Repositories\Activity\ActivityRepository;

class ResultController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $resultRepository;
    protected $lessonRepository;
    protected $answerRepository;
    protected $wordRepository;
    protected $activityRepository;

    public function __construct(
        ResultRepository $resultRepository,
        LessonRepository $lessonRepository,
        AnswerRepository $answerRepository,
        WordRepository $wordRepository,
        ActivityRepository $activityRepository
    ) {
        $this->resultRepository = $resultRepository;
        $this->lessonRepository = $lessonRepository;
        $this->answerRepository = $answerRepository;
        $this->wordRepository = $wordRepository;
        $this->activityRepository = $activityRepository;
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $categoryName = $data['category_name'];
        $categoryId = $data['category_id'];
        $results = $request->except('_token', 'category_name', 'category_id');
        $words = $this->wordRepository->getWordsWithAnswer($results);
        $countCorrect = $this->resultRepository->insertLessonAndAnswers($categoryId, $results, $this->answerRepository, $this->lessonRepository);
        $inputs['user_id'] = $this->currentUser->id;
        $inputs['type'] = config('settings.is_completed');
        $this->activityRepository->create($inputs);

        return view('user.result',compact('words', 'results', 'categoryName', 'countCorrect'));
    }
}
