<?php
namespace Tests\NasaApiBundle;

use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use NasaApiBundle\Client\NasaApiClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * Description of NasaApiTestCase
 *
 * @author runish.kumar<runish.kumar@rocket-internet.de>
 */
class NasaApiTestCase extends KernelTestCase
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::bootKernel();

        // Store the container and the entity manager in test case properties
        $this->container = static::$kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine')->getManager();

        /* @var $client NasaApiClient */
        $client = new NasaApiClientMock('baseurl', 'fake-api-key', $this->container->get('serializer'));

        $this->container->set('nasa.api.client', $client);

        // Build the schema for sqlite
        $this->generateSchema();
    }

    public function tearDown()
    {
        $this->client = null;

        parent::tearDown();

        $this->dropDatabase();
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function generateSchema()
    {
        // Get the metadata of the application to create the schema.
        $metadata = $this->getMetadata();

        if (! empty($metadata)) {
            // Create SchemaTool
            $tool = new SchemaTool($this->entityManager);

            $tool->updateSchema($metadata, true);
        } else {
            throw new SchemaException('No Metadata Classes to process.');
        }
    }

    protected function dropDatabase()
    {
        $tool = new SchemaTool($this->entityManager);
        $tool->dropDatabase();
    }

    /**
     * Overwrite this method to get specific metadata.
     *
     * @return array
     */
    protected function getMetadata()
    {
        return $this->entityManager->getMetadataFactory()->getAllMetadata();
    }
}
