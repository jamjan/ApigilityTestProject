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
    private $accessToken;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../../../../config/application.config.php'
        );

        $this->accessToken = '005df72fc50bc2f58bc07057beca3732c1de4def';

        parent::setUp();

    }

    public function testHeartbeatActionInvalidContentType()
    {
        $request = $this->getRequest();
        $request->setMethod('GET');

        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(406);
    }

    public function testHeartbeatActionOk()
    {
        $request = $this->getRequest();
        $request->setMethod('GET');

        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');

        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(200);

        $body = $this->getResponse()->getContent();
        $data = Json::decode($body, Json::TYPE_ARRAY);

        $this->assertEquals(array('status'=>'ok'), $data);
    }

    public function testHeartbeatActionUnauthorized()
    {
        $request = $this->getRequest();
        $request->setMethod('GET');

        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');

        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(403);
    }

    public function testHeartbeatActionAuthorizedOauth()
    {
        $request = $this->getRequest();
        $request->setMethod('GET');

        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('Authorization', 'Bearer ' . $this->accessToken);
        $_SERVER['HTTP_AUTHORIZATION']  = 'Bearer '. $this->accessToken;

        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(200);
    }

    public function testHeartbeatActionAuthorizedHttp()
    {
        $request = $this->getRequest();
        $request->setMethod('GET');

        $headers = $this->getRequest()->getHeaders();
        $headers->addHeaderLine('Accept', 'application/json');
        $headers->addHeaderLine('WWW-Authenticate', 'Basic realm="api"');
        $headers->addHeaderLine('Authorization', 'Basic '.base64_encode('testclient:testpass'));

        $this->dispatch('/heartbeat');

        $this->assertModuleName('TestProject');
        $this->assertControllerClass('HeartbeatController');

        $this->assertResponseStatusCode(200);
    }

}