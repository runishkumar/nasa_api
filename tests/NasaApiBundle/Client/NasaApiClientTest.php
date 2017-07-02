<?php
namespace Tests\NasaApiBundle\Client;

/**
 * Description of NasaApiClientTest
 *
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NasaApiClientTest extends \Tests\NasaApiBundle\NasaApiTestCase
{

    public function testFetchFeedData()
    {
        $client = $this->getContainer()->get('nasa.api.client');

        $startDate = new \DateTime();
        $data = $client->fetchFeedData($startDate);

        $this->assertInstanceOf(\NasaApiBundle\Client\NeoFeedResult::class, $data);
        $this->assertEquals(5, $data->getElementCount());
    }

}
