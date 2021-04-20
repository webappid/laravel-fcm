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
        $notificationRepositoryRequest = app()->make(\WebAppId\Fcm\Repositories\Requests\NotificationRepositoryRequest::class);
        $notificationRepositoryRequest->code = \Illuminate\Support\Str::uuid();
        $notificationRepositoryRequest->title = $title;
        $notificationRepositoryRequest->body = $body;
        $notificationRepositoryRequest->action = $urlAction;
        $notificationRepositoryRequest->user_id = \Illuminate\Support\Facades\Auth::id();
        $notificationRepositoryRequest->receiver_id = $userId;

        $notificationRepository = app()->make(\WebAppId\Fcm\Repositories\NotificationRepository::class);
        app()->call([$notificationRepository, 'store'], compact('notificationRepositoryRequest'));

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
