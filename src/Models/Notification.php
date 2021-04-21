<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace WebAppId\Fcm\Models;

use Illuminate\Database\Eloquent\Model;
use WebAppId\Lazy\Traits\ModelTrait;

/**
 * @author: 
 * Date: 08:08:57
 * Time: 2021/04/20
 * Class Notification
 * @package WebAppId\Fcm\Models
 */
class Notification extends Model
{
    use ModelTrait;
    protected $table = 'notifications';
    protected $fillable = ['id', 'code', 'user_id', 'receiver_id', 'title', 'body', 'action', 'created_at', 'updated_at'];
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
