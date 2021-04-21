<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 05:49:11
 * Time: 2021/04/19
 * Class FcmLog
 * @package WebAppId\Fcm\Models
 */
class FcmLog extends Model
{
    use ModelTrait;
    protected $table = 'fcm_logs';
    protected $fillable = ['id', 'fcm_subscribe_id', 'request', 'response', 'user_id', 'created_at', 'updated_at'];
    protected $hidden = [];

    /**
     * @param bool $isFresh
     * @return mixed
     */
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
