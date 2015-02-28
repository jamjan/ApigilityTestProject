<?php
namespace TestProject\V1\Rpc\Heartbeat;

class HeartbeatControllerFactory
{
    public function __invoke($controllers)
    {
        return new HeartbeatController();
    }
}
