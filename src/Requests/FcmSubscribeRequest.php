<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: 
 * Date: 04:26:43
 * Time: 2021/04/18
 * Class FcmSubscribeRequest
 * @package WebAppId\Fcm\Requests
 */

class FcmSubscribeRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'fcm_project_id' => 'nullable|int',
            'token' => 'required|max:191|string',
            'active' => 'nullable|max:3|string',
            'agent' => 'required|max:191|string',
        ];
    }
}
