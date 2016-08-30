<?php
namespace App\Repositories\Answer;

use Auth;
use App\Models\Answer;
use App\Repositories\BaseRepository;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Lesson\LessonRepository;

class AnswerRepository extends BaseRepository
{
    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function getListLearnedWordId(ResultRepository $resultRepository, LessonRepository $lessonRepository)
    {
        $listWordId = $this->model->distinct()->whereIn('id', $resultRepository->getAnswerId($lessonRepository))->where('is_correct', config('settings.is_correct'))->pluck('word_id');

        return $listWordId;
    }

    public function getListAnswerId()
    {
        $listAnswerId = $this->model->where('is_correct', config('settings.is_correct'))->pluck('id');

        return $listAnswerId;
    }

    public function getWordIdByAnswerId($answerId)
    {
        $answer = $this->model->find($answerId);
        $wordId = $answer->word->id;

        return $wordId;
    }
}
