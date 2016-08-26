<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Repositories\Word\WordRepository;
use App\Repositories\Category\CategoryRepository;

class WordController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $wordRepository;
    protected $categoryRepository;

    public function __construct(WordRepository $wordRepository, CategoryRepository $categoryRepository)
    {
        $this->wordRepository = $wordRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getListCategory();
        $words = $this->wordRepository->all();

        return view('user.word_list', compact('categories', 'words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
