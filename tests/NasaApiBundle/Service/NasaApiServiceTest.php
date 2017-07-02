<?php
namespace Tests\NasaApiBundle\Service;

/**
 * Description of NasaApiServiceTest
 *
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NasaApiServiceTest extends \Tests\NasaApiBundle\NasaApiTestCase
{
    public function testImportFeed()
    {
        $service = $this->getContainer()->get('nasa.api.service');
        $service->importFeedData();
    }
}
