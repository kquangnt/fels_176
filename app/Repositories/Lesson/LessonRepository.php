<?php
namespace App\Repositories\Lesson;

use Auth;
use App\Models\Lesson;
use App\Repositories\BaseRepository;
use App\Repositories\Relationship\RelationshipRepository;

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

    public function getLessonsFollowedUser(RelationshipRepository $relationshipRepository)
    {
        $lessons = $this->model->whereIn('user_id', $relationshipRepository->getListFollowedUserId())->orderBy('id', 'desc')->paginate(config('settings.limit'));

        return $lessons;
    }
}
