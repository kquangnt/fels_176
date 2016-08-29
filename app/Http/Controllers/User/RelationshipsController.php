<?php
namespace App\Http\Controllers\User;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Relationship\RelationshipRepository;

class RelationshipsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $relationshipRepository;

    public function __construct(RelationshipRepository $relationshipRepository)
    {
        $this->relationshipRepository = $relationshipRepository;
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        try {
            $inputs = $request->only('follower_id');
            $inputs['following_id'] = $this->currentUser->id;
            $this->relationshipRepository->follow($inputs);
        } catch (Exception $e) {
            return view('user.home')->withError($e->getMessage());
        }

        return redirect()->action('User\UsersController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        try {
            $inputs = $request->all();
            $followerId = $inputs['follower_id'];
            $this->relationshipRepository->unfollow($id, $followerId);
        } catch (Exception $e) {
            return view('user.home')->withError($e->getMessage());
        }

        return redirect()->action('HomeController@index');
    }

}
