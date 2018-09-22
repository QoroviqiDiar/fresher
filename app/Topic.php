<?php

namespace App;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;



class Topic extends Model
{
    use Orderable;

    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->oldestFirst();
    }


    // Change the column for route model binding
//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
}
