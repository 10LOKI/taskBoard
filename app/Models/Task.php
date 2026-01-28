<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','description','deadline','priority','status','user_id'];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
