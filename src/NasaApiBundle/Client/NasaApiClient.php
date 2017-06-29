<?php
namespace NasaApiBundle\Client;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

/**
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NasaApiClient extends Client
{
    const NEO_FEED_URI = 'neo/rest/v1/feed';

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param string $baseUri
     * @param string $apiKey
     * @param Serializer $serializer
     */
    function __construct($baseUri, $apiKey, Serializer $serializer)
    {
        $this->baseUri = $baseUri;
        $this->apiKey = $apiKey;
        $this->serializer = $serializer;

        parent::__construct([
            'base_uri' => $this->baseUri
        ]);
    }

    public function fetchFeedData(\DateTimeInterface $startDate, \DateTimeInterface $endDate=null)
    {
        if (!$endDate) {
            $endDate = new \DateTime();
        }

        $filter = [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'detailed' => false,
            'api_key' => $this->apiKey
        ];

        $response = $this->get(sprintf("%s?%s", self::NEO_FEED_URI, http_build_query($filter)));

        if ($response->getStatusCode() === Response::HTTP_OK) {
            $responseData = $response->getBody()->getContents();

            return $this->serializer->deserialize($responseData, NeoFeedResult::class, 'json');
        } else {
            throw new \Exception("Api error");
        }
    }
}
