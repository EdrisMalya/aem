<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allow($level='c', $category = null, $roles = null)
    {
        if (Auth::check()){
            if (\auth()->id() == 1){
                return true;
            }else{
                $category_obj = AuthorizationCategory::whereName($category)->first();
                if ($category_obj==null){
                    return self::check($level);
                }else{
                    $rules = Rule::whereIn('key',$roles)->where('authorization_category_id',$category_obj->id)->pluck('id')->toArray();
                    if (count($rules) > 0){
                        $user_role_id = \auth()->user()->role_id;
                        $assigned_role_count = AssignedRules::whereRuleId($user_role_id)->whereIn('role_id',$rules)->count();
                        if ($assigned_role_count > 0){
                            return true;
                        }else{
                            return self::check($level);
                        }
                    }
                }
            }
        }else{
            return redirect()->to(route('login'));
        }
    }

    public static function check($level)
    {
        switch ($level){
            case 'c':
                abort(401);
                break;
            case 'v':
                return false;
            default:
                abort(401);
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function manager()
    {
        return User::find($this->user_id);
    }

    public function tasks()
    {
        return $this->hasMany(MyWork::class);
    }
}
