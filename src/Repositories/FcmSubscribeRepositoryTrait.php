<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Fcm\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Models\FcmSubscribe;
use WebAppId\Fcm\Repositories\Requests\FcmSubscribeRepositoryRequest;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author:
 * Date: 04:25:46
 * Time: 2021/04/18
 * Trait FcmSubscribeRepositoryTrait
 * @package WebAppId\Fcm\Repositories
 */
trait FcmSubscribeRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'fcm_subscribes.creator_id';
        $users->type = 'inner';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

        $fcm_projects = app()->make(Join::class);
        $fcm_projects->class = FcmProject::class;
        $fcm_projects->foreign = 'fcm_subscribes.fcm_project_id';
        $fcm_projects->type = 'inner';
        $fcm_projects->primary = 'fcm_projects.id';
        $this->joinTable['fcm_projects'] = $fcm_projects;

        $owner_users = app()->make(Join::class);
        $owner_users->class = User::class;
        $owner_users->foreign = 'fcm_subscribes.owner_id';
        $owner_users->type = 'inner';
        $owner_users->primary = 'owner_users.id';
        $this->joinTable['owner_users'] = $owner_users;

        $user_users = app()->make(Join::class);
        $user_users->class = User::class;
        $user_users->foreign = 'fcm_subscribes.user_id';
        $user_users->type = 'inner';
        $user_users->primary = 'user_users.id';
        $this->joinTable['user_users'] = $user_users;

    }

    /**
     * @inheritDoc
     */
    public function store(FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribe $fcmSubscribe): ?FcmSubscribe
    {
        try {
            $fcmSubscribe = Lazy::copy($fcmSubscribeRepositoryRequest, $fcmSubscribe);
            $fcmSubscribe->save();
            return $fcmSubscribe;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FcmSubscribeRepositoryRequest $fcmSubscribeRepositoryRequest, FcmSubscribe $fcmSubscribe): ?FcmSubscribe
    {
        $fcmSubscribe = $fcmSubscribe->where('id', $id)->first();
        if($fcmSubscribe != null){
            try {
                $fcmSubscribe = Lazy::copy($fcmSubscribeRepositoryRequest, $fcmSubscribe);
                $fcmSubscribe->save();
                return $fcmSubscribe;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $fcmSubscribe;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FcmSubscribe $fcmSubscribe): bool
    {
        $fcmSubscribe = $fcmSubscribe->where('fcm_subscribes.id',$id)->first();
        if($fcmSubscribe!=null){
            return $fcmSubscribe->delete();
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
            return $query->where('fcm_subscribes.token', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(FcmSubscribe $fcmSubscribe, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getCount(FcmSubscribe $fcmSubscribe, string $q = null): int
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByToken(string $token, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('fcm_subscribes.token', '=', $token )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByTokenList(string $token, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getById(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('fcm_subscribes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByFcmProjectId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('fcm_projects.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByFcmProjectIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('fcm_projects.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('owner_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('owner_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('owner_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('user_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByUserUserEmail(string $email, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('user_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
    public function getByUserUserId(int $id, FcmSubscribe $fcmSubscribe):? FcmSubscribe
    {
        return $this
            ->getJoin($fcmSubscribe)
            ->where('user_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, FcmSubscribe $fcmSubscribe, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmSubscribe)
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
