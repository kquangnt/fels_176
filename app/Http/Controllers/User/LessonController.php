<?php
namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Word\WordRepository;

class LessonController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $wordRepository;

    public function __construct(WordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $categoryId = $data['category_id'];
        $categoryName = $data['category_name'];
        $words = $this->wordRepository->getListWordsForLesson($categoryId);

        return view('user.lesson', compact('words', 'categoryName', 'categoryId'));
    }
}
