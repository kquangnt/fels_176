<?php
namespace App\Repositories\Lesson;

use Auth;
use App\Models\Lesson;
use App\Repositories\BaseRepository;

class LessonRepository extends BaseRepository
{
    public function __construct(Lesson $lesson)
    {
        $this->model = $lesson;
    }

    public function getLessonId()
    {
        $currentUserId = Auth::user()->id;
        $listLessonId = $this->model->where('user_id', $currentUserId)->pluck('id');

        return $listLessonId;
    }
}
