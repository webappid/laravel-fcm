<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmLog;
use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Repositories\Requests\FcmLogRepositoryRequest;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 05:49:29
 * Time: 2021/04/19
 * Trait FcmLogRepositoryTrait
 * @package WebAppId\Fcm\Repositories
 */
trait FcmLogRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $fcm_subscribes = app()->make(Join::class);
        $fcm_subscribes->class = FcmSubscribe::class;
        $fcm_subscribes->foreign = 'fcm_logs.fcm_subscribe_id';
        $fcm_subscribes->type = 'inner';
        $fcm_subscribes->primary = 'fcm_subscribes.id';
        $this->joinTable['fcm_subscribes'] = $fcm_subscribes;

        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'fcm_logs.user_id';
        $users->type = 'inner';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

    }

    /**
     * @inheritDoc
     */
    public function store(FcmLogRepositoryRequest $fcmLogRepositoryRequest, FcmLog $fcmLog): ?FcmLog
    {
        try {
            $fcmLog = Lazy::copy($fcmLogRepositoryRequest, $fcmLog);
            $fcmLog->save();
            return $fcmLog;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FcmLogRepositoryRequest $fcmLogRepositoryRequest, FcmLog $fcmLog): ?FcmLog
    {
        $fcmLog = $fcmLog->where('id', $id)->first();
        if($fcmLog != null){
            try {
                $fcmLog = Lazy::copy($fcmLogRepositoryRequest, $fcmLog);
                $fcmLog->save();
                return $fcmLog;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $fcmLog;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FcmLog $fcmLog): bool
    {
        $fcmLog = $fcmLog->where('fcm_logs.id',$id)->first();
        if($fcmLog!=null){
            return $fcmLog->delete();
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
            return $query;
        });

    }

    /**
     * @inheritDoc
     */
    public function get(FcmLog $fcmLog, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
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
    public function getCount(FcmLog $fcmLog, string $q = null): int
    {
        return $this
            ->getJoin($fcmLog)
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
    public function getById(int $id, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('fcm_logs.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('fcm_logs.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByFcmSubscribeToken(string $token, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('fcm_subscribes.token', '=', $token )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByFcmSubscribeTokenList(string $token, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('fcm_subscribes.token', '=', $token )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByFcmSubscribeId(int $id, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('fcm_subscribes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByFcmSubscribeIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('fcm_subscribes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
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
    public function getByUserEmail(string $email, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
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
    public function getByUserId(int $id, FcmLog $fcmLog):? FcmLog
    {
        return $this
            ->getJoin($fcmLog)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, FcmLog $fcmLog, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmLog)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
