<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;

class LessonController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $wordRepository;

    public function __construct(WordRepository $wordRepository, CategoryRepository $categoryRepository)
    {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $data = $request->all();

        if (isset($data['category_id']) && isset($data['category_name'])) {
            $categoryId = $data['category_id'];
            $categoryName = $data['category_name'];
        } else {
            $category = $this->categoryRepository->all();
            $categoryId = $category->first()->id;
            $categoryName = $category->first()->name;
        }

        $words = $this->wordRepository->getListWordsForLesson($categoryId);

        return view('user.lesson', compact('words', 'categoryName', 'categoryId'));
    }
}
