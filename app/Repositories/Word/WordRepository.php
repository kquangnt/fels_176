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

    public function getWordsWithCategoryId($categoryId)
    {
        $words = $this->model->where(function($query) use ($categoryId) {
            if (!empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }
        })
        ->orderBy('content')
        ->get();

        return $words;
    }

    public function getListLearnedWords($words, LessonRepository $lessonRepository, ResultRepository $resultRepository, AnswerRepository $answerRepository)
    {
        $learnedWords = $this->model->whereIn('id', $words->pluck('id'))->whereIn('id', $answerRepository->getListWordId($lessonRepository, $resultRepository))->orderBy('content')->get();

        return $learnedWords;
    }

    public function getNotLearnedWord($learnedIdWords)
    {
        $notLearnedWords = $this->model->whereNotIn('id', $learnedIdWords)->orderBy('content')->get();

        return $notLearnedWords;
    }

    public function getNotLearnedWordWithCategory($categoryId, $learnedIdWords)
    {
        $notLearnedWords = $this->model->where('category_id', $categoryId)->whereNotIn('id', $learnedIdWords)->orderBy('content')->get();

        return $notLearnedWords;
    }
}
