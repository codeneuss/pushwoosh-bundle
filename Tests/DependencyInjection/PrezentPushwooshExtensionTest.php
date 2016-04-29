<?php

namespace Prezent\PushwooshBundle\Tests\DependencyInjection;

use Prezent\PushwooshBundle\DependencyInjection\PrezentPushwooshExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PrezentPushwooshExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PrezentPushwooshExtension
     */
    private $extension;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->extension = new PrezentPushwooshExtension();
        $this->container = new ContainerBuilder();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->extension = null;
        $this->container = null;
    }

    public function testConfigValuesAreSetCorrectly()
    {
        $applicationId = 'XXX-XXX';
        $applicationGroupId = 'YYY-YYYY';
        $apiKey = 'xxxxxxxxxxxxxx';
        $clientClass = 'Gomoob\Pushwoosh\Client\PushwooshMock';
        $logRequests = true;

        $this->extension->load(
            [
                [
                    'application_id' => $applicationId,
                    'application_group_id' => $applicationGroupId,
                    'api_key' => $apiKey,
                    'client_class' => 'Gomoob\Pushwoosh\Client\PushwooshMock',
                    'log_requests' => true,
                ]
            ],
            $this->container
        );

        $this->assertEquals($applicationId, $this->container->getParameter('prezent_pushwoosh.application_id'));
        $this->assertEquals($applicationGroupId, $this->container->getParameter('prezent_pushwoosh.application_group_id'));
        $this->assertEquals($apiKey, $this->container->getParameter('prezent_pushwoosh.api_key'));
        $this->assertEquals($logRequests, $this->container->getParameter('prezent_pushwoosh.log_requests'));

        $client = $this->container->get('pushwoosh');
        $this->assertEquals($clientClass, get_class($client));
    }
}