<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        $currentUser = Auth::user();
        if ($id != $currentUser->id) {
            return view('user.home')->withErrors(trans('message.not_permission'));
        }

        return view('user.profile', ['user' => $currentUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->only(['email', 'name', 'password', 'avatar']);
            $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            return view('home')->withError(trans('message.update_error'));
        }

        return view('home')->withSuccess(trans('message.edit_user_successfully'));
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
