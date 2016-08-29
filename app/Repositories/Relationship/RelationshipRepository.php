<?php
namespace App\Repositories\Relationship;

use App\Models\Relationship;
use App\Repositories\BaseRepository;
use Auth;

class RelationshipRepository extends BaseRepository
{
    public function __construct(Relationship $relationship)
    {
        $this->model = $relationship;
    }

    public function unfollow($id, $follower_id)
    {
        return $this->model->where('following_id', $id)->where('follower_id', $follower_id)->delete();
    }

    public function follow($inputs)
    {
        return $this->model->create($inputs);
    }

    public function getListFollowerId()
    {
        $currentId = $this->getCurrentUser()->id;
        $listFollowerId = $this->model->where('following_id', $currentId)->pluck('follower_id');

        return $listFollowerId;
    }

    public function getListFollowedUserId()
    {
        $currentId = $this->getCurrentUser()->id;
        $listFollowerUserId = $this->model->where('following_id', $currentId)->lists('follower_id');
        $listFollowerUserId->push($currentId);

        return $listFollowerUserId;
    }
}
