<?php


namespace WebAppId\Fcm\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProject
 * @package WebAppId\Fcm\Models
 */
class FcmProject extends Model
{
    use ModelTrait;

    protected $table = 'fcm_projects';
    protected $fillable = ['id', 'name', 'server_key'];
    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    public function subscribes(): HasMany
    {
        return $this->hasMany(FcmSubscribe::class, 'fcm_project_id');
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
