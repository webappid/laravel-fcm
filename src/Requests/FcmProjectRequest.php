<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author:
 * Date: 04:05:45
 * Time: 2021/04/18
 * Class FcmProjectRequest
 * @package WebAppId\Fcm\Requests
 */

class FcmProjectRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'name' => 'required|max:191|string',
            'server_key' => 'required|max:191|string',
        ];
    }
}
