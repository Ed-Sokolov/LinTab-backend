<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    protected $table = 'posts';

    public function image()
    {
        return $this->hasOne(Image::class, "post_id", "id");
    }

    public function views()
    {
        return $this->hasOne(PostViews::class, "post_id", "id");
    }
}
