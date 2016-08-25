<?php
namespace App\Repositories\Word;

use Auth;
use App\Models\Word;
use App\Models\Category;
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

    public function getListCategory()
    {
        $listCategory = Category::lists('name');
        return $listCategory;
    }

    public function getListLearnedWord(ResultRepository $resultRepository, LessonRepository $lessonRepository, AnswerRepository $answerRepository)
    {
        $listLearnedWord = $this->model->whereIn('id' , $answerRepository->getListLearnedWordId($resultRepository, $lessonRepository))->get();

        return $listLearnedWord;
    }
}
