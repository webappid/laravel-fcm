<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\Notification;
use WebAppId\Fcm\Repositories\Requests\NotificationRepositoryRequest;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 08:09:13
 * Time: 2021/04/20
 * Trait NotificationRepositoryTrait
 * @package WebAppId\Fcm\Repositories
 */
trait NotificationRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'notifications.receiver_id';
        $users->type = 'inner';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

        $user_users = app()->make(Join::class);
        $user_users->class = User::class;
        $user_users->foreign = 'notifications.user_id';
        $user_users->type = 'inner';
        $user_users->primary = 'user_users.id';
        $this->joinTable['user_users'] = $user_users;

    }

    /**
     * @inheritDoc
     */
    public function store(NotificationRepositoryRequest $notificationRepositoryRequest, Notification $notification): ?Notification
    {
        try {
            $notification = Lazy::copy($notificationRepositoryRequest, $notification);
            $notification->save();
            return $notification;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $code, NotificationRepositoryRequest $notificationRepositoryRequest, Notification $notification): ?Notification
    {
        $notification = $notification->where('code', $code)->first();
        if($notification != null){
            try {
                $notification = Lazy::copy($notificationRepositoryRequest, $notification);
                $notification->save();
                return $notification;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $notification;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $code, Notification $notification): bool
    {
        $notification = $notification->where('notifications.code',$code)->first();
        if($notification!=null){
            return $notification->delete();
        }else{
            return false;
        }
    }

    /**
     * @param Builder $query
     * @param string $q
     * @return Builder
     */
    protected Function getFilter(Builder $query, string $q)
    {
        return $query->where(function($query) use ($q){
            return $query->where('notifications.code', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(Notification $notification, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->paginate($length, $this->getColumn())
            ->appends(request()->all());
    }

    /**
     * @inheritDoc
     */
    public function getCount(Notification $notification, string $q = null): int
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->count();
    }

        /**
     * @inheritDoc
     */
    public function getByCode(string $code, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('notifications.code', '=', $code )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCodeList(string $code, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('notifications.code', '=', $code )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('notifications.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('notifications.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('user_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmail(string $email, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('user_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserId(int $id, Notification $notification):? Notification
    {
        return $this
            ->getJoin($notification)
            ->where('user_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, Notification $notification, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($notification)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
