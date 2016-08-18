<?php
namespace App\Repositories\User;

use Auth;
use App\User;
use Input;
use Hash;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($request)
    {
        if (isset($request['avatar'])) {
            $fileName = $this->uploadAvatar(null);
        } else {
            $fileName =  trans('label.avatar_default');
        }

        $user = [
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => $fileName,
            'password' => bcrypt($request['password']),
        ];

        $createUser = $this->model->create($user);

        if (!$createUser) {
            throw new Exception('message.create_error');
        }

        return $createUser;
    }

    public function uploadAvatar($oldImage)
    {
        $file = Input::file('avatar');
        $destinationPath = base_path().trans('user.avatar_path');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        Input::file('avatar')->move($destinationPath, $fileName);
        if (!empty($oldImage) && file_exists($oldImage)) {
            File::delete($oldImage);
        }
        return $fileName;
    }
}
