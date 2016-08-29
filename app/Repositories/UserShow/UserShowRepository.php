<?php
namespace App\Repositories\UserShow;

use Auth;
use App\User;
use App\Repositories\BaseRepository;
use App\Repositories\Relationship\RelationshipRepository;

class UserShowRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getLessonsNotFollowedUser(RelationshipRepository $relationshipRepository)
    {
        $currentId = $this->getCurrentUser()->id;
        $lessons = $this->model->where('id', '!=', $currentId)->whereNotIn('id', $relationshipRepository->getListFollowerId())->paginate(config('settings.limit'));

        return $lessons;
    }
}
