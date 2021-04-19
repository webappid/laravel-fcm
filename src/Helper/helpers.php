<?php

use WebAppId\Fcm\Models\Notify;
use WebAppId\Fcm\Services\FcmService;
use WebAppId\Fcm\Services\Requests\FcmSendServiceRequest;

/**
 * Created by PhpStorm.
 */
if (!function_exists('pushNotify')) {
    function pushNotify(string $urlAction, string $title, string $body, int $userId, string $icon)
    {
        $notify = app()->make(Notify::class);
        $notify->url_action = $urlAction;
        $notify->body = $body;
        $notify->title = $title;
        $fcmService = app()->make(FcmService::class);
        $notify->icon = $icon;

        $fcmSendServiceRequest = app()->make(FcmSendServiceRequest::class);
        $fcmSendServiceRequest->notification = $notify;

        $id = $userId;
        $fcmService = app()->make(FcmService::class);
        app()->call([$fcmService, 'send'], compact('id', 'fcmSendServiceRequest'));
    }
}
