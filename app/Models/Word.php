<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['content', 'category_id'];

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
