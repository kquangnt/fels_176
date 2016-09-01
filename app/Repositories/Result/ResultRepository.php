<?php
namespace App\Repositories\Result;

use Auth;
use DB;
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

    public function insertLessonAndAnswers($categoryId, $results, AnswerRepository $answerRepository, LessonRepository $lessonRepository)
    {
        $mark = 0;
        $allResults = [];
        try {
            DB::beginTransaction();
            $lesson = $lessonRepository->insertLesson($categoryId);
            foreach ($results as $key => $value) {
                $wordId = $answerRepository->getWordIdByAnswerId($value);
                $allResults[] = [
                    'lesson_id' => $lesson->id,
                    'word_id' => $wordId,
                    'answer_id' => $value,
                ];

                if ($answerRepository->find($value)->is_correct) {
                     $mark++;
                }
            }
            $this->model->insert($allResults);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $mark;
    }

    public function getResultsOfLesson($lessonId)
    {
        $results = $this->model->where('lesson_id', $lessonId)->get();

        return $results;
    }

    public function getListAnswerId(LessonRepository $lessonRepository)
    {
        $listAnswerId = $this->model->whereIn('lesson_id', $lessonRepository->getListLessonId())->pluck('answer_id');

        return  $listAnswerId;
    }
}
