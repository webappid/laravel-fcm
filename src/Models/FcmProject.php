<?php


namespace WebAppId\Fcm\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProject
 * @package WebAppId\Fcm\Models
 */
class FcmProject extends Model
{
    protected $table = 'fcm_projects';
    protected $fillable = ['id', 'name', 'server_key'];
    protected $hidden = ['user_id', 'created_at', 'updated_at'];
    
    public function subscribes(): HasMany
    {
        return $this->hasMany(FcmSubscribe::class, 'fcm_project_id');
    }
}