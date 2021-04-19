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
use WebAppId\Fcm\Repositories\Requests\FcmProjectRepositoryRequest;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 02:03:24
 * Time: 2021/04/18
 * Trait FcmProjectRepositoryTrait
 * @package WebAppId\Fcm\Repositories
 */
trait FcmProjectRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'fcm_projects.user_id';
        $users->type = 'inner';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

    }

    /**
     * @inheritDoc
     */
    public function store(FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProject $fcmProject): ?FcmProject
    {
        try {
            $fcmProject = Lazy::copy($fcmProjectRepositoryRequest, $fcmProject);
            $fcmProject->save();
            return $fcmProject;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, FcmProjectRepositoryRequest $fcmProjectRepositoryRequest, FcmProject $fcmProject): ?FcmProject
    {
        $fcmProject = $fcmProject->where('id', $id)->first();
        if($fcmProject != null){
            try {
                $fcmProject = Lazy::copy($fcmProjectRepositoryRequest, $fcmProject);
                $fcmProject->save();
                return $fcmProject;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $fcmProject;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, FcmProject $fcmProject): bool
    {
        $fcmProject = $fcmProject->where('fcm_projects.id',$id)->first();
        if($fcmProject!=null){
            return $fcmProject->delete();
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
    public function get(FcmProject $fcmProject, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmProject)
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
    public function getCount(FcmProject $fcmProject, string $q = null): int
    {
        return $this
            ->getJoin($fcmProject)
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
    public function getById(int $id, FcmProject $fcmProject):? FcmProject
    {
        return $this
            ->getJoin($fcmProject)
            ->where('fcm_projects.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmProject)
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
    public function getByUserApiToken(string $apiToken, FcmProject $fcmProject):? FcmProject
    {
        return $this
            ->getJoin($fcmProject)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmProject)
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
    public function getByUserEmail(string $email, FcmProject $fcmProject):? FcmProject
    {
        return $this
            ->getJoin($fcmProject)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmProject)
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
    public function getByUserId(int $id, FcmProject $fcmProject):? FcmProject
    {
        return $this
            ->getJoin($fcmProject)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, FcmProject $fcmProject, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($fcmProject)
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
