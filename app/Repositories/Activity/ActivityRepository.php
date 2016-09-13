<?php
namespace App\Repositories\Activity;

use App\Models\Activity;
use App\Repositories\BaseRepository;
use App\Repositories\Activity\ActivityRepository;

class ActivityRepository extends BaseRepository
{
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }
}
