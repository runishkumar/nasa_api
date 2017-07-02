<?php
namespace Tests\NasaApiBundle;

/**
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NasaApiClientMock extends \NasaApiBundle\Client\NasaApiClient
{
    function __construct($baseUri, $apiKey, $serializer)
    {
        parent::__construct($baseUri, $apiKey, $serializer);
    }

    /**
     * @param \DateTime $startData
     * @param \DateTime $endDate
     * @return NeoFeedResult
     */
    public function get($uri)
    {
        $content = $this->loadDataFromFile('neo_feed.json');

        $response = new \GuzzleHttp\Psr7\Response(200);
        $body = new \GuzzleHttp\Psr7\Stream(fopen('php://temp', 'w+'));
        $body->write($content);
        $body->seek(0);

        $response = $response->withBody($body);
        return $response;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    protected function loadDataFromFile($fileName)
    {
        return file_get_contents(sprintf('%s/../../var/fixtures/%s', __DIR__, $fileName));
    }
}
