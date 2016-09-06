<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate(config('settings.limit'));

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->only('name', 'email', 'avatar', 'password');

        if ($this->userRepository->create($input)) {
            return redirect()->route('admin.user.index')->with('success', trans('user.create_user_successfully'));
        }

        return redirect()->route('admin.user.index')->with('errors', trans('user.create_user_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('errors', trans('user.user_not_found'));
        }

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('errors', trans('user.user_not_found'));
        }

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $input = $request->only('name', 'email', 'avatar', 'password');

        if ($this->userRepository->update($input, $id)) {
            return redirect()->route('admin.user.index')->with('success', trans('user.update_user_successfully'));
        }

        return redirect()->route('admin.user.index')->with('errors', trans('user.update_user_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('errors', trans('user.user_not_found'));
        }

        if ($user->delete()) {
            return redirect()->route('admin.user.index')->with('success', trans('user.delete_user_successfully'));
        }

        return redirect()->route('admin.user.index')->with('errors', trans('user.delete_user_fail'));
    }
}
