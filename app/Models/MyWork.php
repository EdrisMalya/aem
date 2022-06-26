<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyWork extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(MyWorkFiles::class);
    }

    public function tasks()
    {
        return $this->hasMany(MyWork::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
