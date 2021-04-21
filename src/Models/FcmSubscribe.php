<?php

namespace WebAppId\Fcm\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmSubscribe
 * @package WebAppId\Fcm\Models
 */
class FcmSubscribe extends Model
{
    use ModelTrait;
    
    protected $table = 'fcm_subscribes';
    protected $fillable = ['id', 'owner_id', 'fcm_project_id', 'token', 'active', 'agent'];
    protected $hidden = ['user_id', 'created_at', 'updated_at'];
    
    public function project(){
        return $this->belongsTo(FcmProject::class, 'fcm_project_id');
    }

    public function getColumns(bool $isFresh = false)
    {
        $columns = $this->getAllColumn($isFresh);

        $forbiddenField = [
            "created_at",
            "updated_at"
        ];
        foreach ($forbiddenField as $item) {
            unset($columns[$item]);
        }

        return $columns;
    }
}