<?php
/**
 * 
 * @author: Zdenek
 * @copyright 2015, Loft Digital, www.loftdigital.com
 */
namespace TestProjectTest\V1\Rpc\Heartbeat;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Json\Json;

class HeartbeatControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../../../../config/application.config.php'
        );
        parent::setUp();

    }

    public function testHeartbeatAction()
    {
        $request = $this->getRequest();

        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');

        $request->setMethod('GET');
        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(200);

        $body = $this->getResponse()->getContent();
        $data = Json::decode($body, Json::TYPE_ARRAY);

        $this->assertEquals(array('status'=>'ok'), $data);
    }

}