<?php

namespace WebAppId\Fcm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribe
 * @package WebAppId\Fcm\Models
 */
class FcmSubscribe extends Model
{
    protected $table = 'fcm_subscribes';
    protected $fillable = ['id', 'owner_id', 'fcm_project_id', 'token', 'active', 'agent'];
    protected $hidden = ['user_id', 'created_at', 'updated_at'];
    
    public function project(){
        return $this->belongsTo(FcmProject::class, 'fcm_project_id');
    }
}