<?php
namespace TestProject\V1\Rpc\Heartbeat;

use Zend\Mvc\Controller\AbstractActionController;

class HeartbeatController extends AbstractActionController
{
    public function heartbeatAction()
    {
        return array("status" => "ok");
    }
}
