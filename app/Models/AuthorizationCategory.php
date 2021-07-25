<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}
