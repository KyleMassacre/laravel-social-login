<?php

namespace KyleMass\SocialLogin\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProviders extends Model
{
    protected $table = 'social_providers';
    protected $fillable = ['user_id','provider','providerId','avatar'];
    public $timestamps = false;


    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}