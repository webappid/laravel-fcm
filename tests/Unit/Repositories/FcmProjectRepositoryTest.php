<?php

namespace WebAppId\Fcm\Tests\Unit\Repositories;

use WebAppId\Fcm\Models\FcmProject;
use WebAppId\Fcm\Repositories\FcmProjectRepository;
use WebAppId\Fcm\Services\Params\ProjectParam;
use WebAppId\Fcm\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class FcmProjectRepositoryTest
 * @package WebAppId\Fcm\Tests\Unit\Repositories
 */
class FcmProjectRepositoryTest extends TestCase
{
    /**
     * @var FcmProjectRepository
     */
    private $fcmProjectRepository;
    
    /**
     * @return FcmProjectRepository
     */
    public function fcmProjectRepository(): FcmProjectRepository
    {
        if ($this->fcmProjectRepository == null) {
            $this->fcmProjectRepository = $this->getContainer()->make(FcmProjectRepository::class);
        }
        
        return $this->fcmProjectRepository;
    }
    
    /**
     * @return ProjectParam
     */
    public function dummy(): ProjectParam
    {
        $projectParam = new ProjectParam();
        $projectParam->setName($this->getFaker()->text(30));
        $projectParam->setServerKey($this->getFaker()->password);
        $projectParam->setUserId($this->getFaker()->randomNumber());
        return $projectParam;
    }
    
    /**
     * @return FcmProject|null
     */
    public function testStore(): ?FcmProject
    {
        $dummyData = $this->dummy();
        $result = $this->getContainer()->call([$this->fcmProjectRepository(), 'store'], ['projectParam' => $dummyData]);
        self::assertNotEquals(null, $result);
        self::assertNotEquals(null, $result->id);
        return $result;
    }
}
