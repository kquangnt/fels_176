<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getListCategory()
    {
        $listCategory = $this->model->lists('name');

        return $listCategory;
    }

    public function getListCategoryId()
    {
        $listCategory = $this->model->lists('name', 'id');

        return $listCategory;
    }
}
