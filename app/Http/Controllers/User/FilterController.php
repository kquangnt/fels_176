<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;

class FilterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $wordRepository;
    protected $categoryRepository;
    protected $lessonRepository;
    protected $resultRepository;
    protected $answerRepository;

    public function __construct(
        WordRepository $wordRepository,
        CategoryRepository $categoryRepository,
        LessonRepository $lessonRepository,
        ResultRepository $resultRepository,
        AnswerRepository $answerRepository
    ) {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
        $this->lessonRepository = $lessonRepository;
        $this->resultRepository = $resultRepository;
        $this->answerRepository = $answerRepository;
    }

    public function filterWord(Request $request)
    {
        $allInput = $request->only(['optCategory', 'rdLearned']);
        $categories = $this->categoryRepository->lists('name', 'id');
        $selectedCategory = '';
        $rdChoose = isset($allInput['rdLearned']) ? $allInput['rdLearned'] : config('settings.all');

        try {
            switch ($rdChoose) {
                case config('settings.all'):
                    $listWords = $this->wordRepository->getWordsWithCategoryId($allInput['optCategory']);

                    if (isset($allInput['optCategory']) && !empty($allInput['optCategory'])) {
                        $selectedCategory = $listWords->first()->category;
                    }

                    break;
                case config('settings.learned'):
                    $listWordWithCategory = $this->wordRepository->getWordsWithCategoryId($allInput['optCategory']);
                    $listWords = $this->wordRepository->getListLearnedWords($listWordWithCategory, $this->lessonRepository, $this->resultRepository, $this->answerRepository);

                    if (isset($allInput['optCategory']) && !empty($allInput['optCategory'])) {
                        $selectedCategory = $listWords->first()->category;
                    }

                    break;
                case config('settings.not_learned'):
                    $listWordWithCategory = $this->wordRepository->getWordsWithCategoryId($allInput['optCategory']);
                    $learnedWords = $this->wordRepository->getListLearnedWords($listWordWithCategory, $this->lessonRepository, $this->resultRepository, $this->answerRepository);

                    if (isset($allInput['optCategory']) && !empty($allInput['optCategory'])) {
                        $selectedCategory = $learnedWords->first()->category;
                        $listWords = $this->wordRepository->getNotLearnedWordWithCategory($selectedCategory->id, $learnedWords->lists('id'));
                    } else {
                        $listWords = $this->wordRepository->getNotLearnedWord($learnedWords->lists('id'));
                    }

                    break;
            }
        } catch (\Exception $e) {
            return redirect()->action('User\FilterController@filterWord');
        }

        return view('user.word_list', compact('categories', 'selectedCategory', 'rdChoose'))->with('words', $listWords);
    }
}
