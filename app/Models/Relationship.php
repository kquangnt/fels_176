<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = ['following_id', 'follower_id'];
}
