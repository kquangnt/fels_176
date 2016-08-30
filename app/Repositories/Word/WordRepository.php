<?php
namespace App\Repositories\Word;

use Auth;
use App\Models\Word;
use App\Repositories\BaseRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;

class WordRepository extends BaseRepository
{
    public function __construct(Word $word)
    {
        $this->model = $word;
    }

    public function getListLearnedWord(ResultRepository $resultRepository, LessonRepository $lessonRepository, AnswerRepository $answerRepository)
    {
        $listLearnedWord = $this->model->whereIn('id' , $answerRepository->getListLearnedWordId($resultRepository, $lessonRepository))->get();

        return $listLearnedWord;
    }

    public function getWordsWithAnswer($results)
    {
        $words = $this->model->whereIn('id', array_keys($results))->get();

        return $words;
    }

    public function getListWordsForLesson($categoryId)
    {
        $words = $this->model->where('category_id', $categoryId)->orderByRaw('RAND()')->take(config('settings.count_question'))->get();

        return $words;
    }
}
