<?php
namespace App\Repositories\Result;

use Auth;
use App\Models\Result;
use App\Repositories\BaseRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;

class ResultRepository extends BaseRepository
{
    public function __construct(Result $result)
    {
        $this->model = $result;
    }

    public function getAnswerId(LessonRepository $lesson)
    {
        $listAnswerId = $this->model->whereIn('lesson_id', $lesson->getLessonId())->pluck('answer_id');

        return $listAnswerId;
    }

    public function countLearnedWords(LessonRepository $lessonRepository, AnswerRepository $answerRepository)
    {
        $countLearnedWords = count($this->model->distinct()->whereIn('lesson_id', $lessonRepository->getLessonId())->whereIn('answer_id', $answerRepository->getListAnswerId())->get(['word_id']));

        return $countLearnedWords;
    }
}
