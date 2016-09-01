<?php
namespace App\Repositories\User;

use Auth;
use App\User;
use App\Models\Word;
use App\Models\Lesson;
use App\Models\Relationship;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Category;
use Input;
use Hash;
use App\Repositories\BaseRepository;
use App\Repositories\Lesson\LessonRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultRepository;


class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function createUserSocial($datas)
    {
        return $this->model->create($data);
    }

    public function getUserWithEmail($providerUser)
    {
        $user = $this->model->whereEmail($providerUser->getEmail())->first();

        return $user;
    }

    public function create($request)
    {
        if (isset($request['avatar'])) {
            $fileName = $this->uploadAvatar(null);
        } else {
            $fileName =  config('settings.avatar_default');
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

    public function update($inputs, $id)
    {
        try {
            $currentUser = Auth::user();
            if (isset($request['password'])) {
                $inputs['password'] = Hash::make($inputs['password']);
            } else {
                $inputs['password'] = $currentUser->password;
            }

            $oldImage = $currentUser->avatar;
            if (isset($inputs['avatar'])) {
                $inputs['avatar'] = $this->uploadAvatar($oldImage);
            } else {
                $inputs['avatar'] = $oldImage;
            }

            $data = $this->model->where('id', $id)->update($inputs);
        } catch (Exception $e) {
            return view('user.home')->withError(trans('message.update_error'));
        }

        return $data;
    }

    public function uploadAvatar($oldImage)
    {
        $file = Input::file('avatar');
        $destinationPath = base_path() . config('settings.avatar_path');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        Input::file('avatar')->move($destinationPath, $fileName);
        if (!empty($oldImage) && file_exists($oldImage)) {
            File::delete($oldImage);
        }

        return $fileName;
    }

    //sum learned words
    public function sumLearnedWords(LessonRepository $lessonRepository, ResultRepository $resultRepository, AnswerRepository $answerRepository)
    {
        $countLearnedWords = $resultRepository->countLearnedWords($lessonRepository, $answerRepository);
        return $countLearnedWords;
    }
}
