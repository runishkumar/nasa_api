<?php
namespace NasaApiBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\ClientInterface;
use NasaApiBundle\Client\NasaApiClient;
use NasaApiBundle\Client\NeoFeedResult;
use NasaApiBundle\Entity\Neo;

class NasaApiService
{

    const BATCH_SIZE = 20;

    /**
     * @var NasaApiClient
     */
    private $client;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param ClientInterface $client
     * @param EntityManagerInterface $entityManager
     */
	function __construct(
        ClientInterface $client,
        EntityManagerInterface $entityManager
    ) {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    /**
     * Fetch NEO info from nasa client between given date range
     *
     * @param \DateTimeInterface $startDate
     * @param \DateTimeInterface $endDate
     */
    public function importFeedData(\DateTimeInterface $startDate=null, \DateTimeInterface $endDate=null)
    {
        $startDate = $startDate ?: new \DateTime('-3 days');
        $endDate = $endDate ?: new \DateTime();

        /* @var $neoList NeoFeedResult */
        $neoList = $this->client->fetchFeedData($startDate, $endDate);

        $this->processAndSaveData($neoList->getNearEarthObjects());
    }

    /**
     * Save Neo list to db
     *
     * @param array $neoList
     * @throws \Exception
     */
    public function processAndSaveData(array $neoList)
    {
        $counter = 0;

        foreach ($neoList as $date => $data) {
            foreach ($data as $neo) {

                /* @var $neoEntity Neo */
                $neoEntity = $this->entityManager->getRepository('NasaApiBundle:Neo')->findOneByReference($neo['neo_reference_id']);

                if (!$neoEntity) {
                    $neoEntity = new Neo();
                }

                $neoEntity->setName($neo['name']);
                $neoEntity->setReference($neo['neo_reference_id']);
                $neoEntity->setIsHazardous($neo['is_potentially_hazardous_asteroid']);
                $neoEntity->setSpeed(sprintf("%.8f", $neo['close_approach_data'][0]['relative_velocity']['kilometers_per_hour']));

                // Unclear in README which date to store in db
                try {
                    $nearDate = new \DateTime($neo['close_approach_data'][0]['close_approach_date']);

                    $neoEntity->setDate($nearDate);

                } catch (\Exception $ex) {
                    throw new \Exception("Unable to parse date. {$ex->getMessage()}");
                }

                $this->entityManager->persist($neoEntity);

                if (++$counter % self::BATCH_SIZE === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
            }
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}