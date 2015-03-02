<?php
return array(
    'controllers' => array(
        'factories' => array(
            'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => 'TestProject\\V1\\Rpc\\Heartbeat\\HeartbeatControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'test-project.rpc.heartbeat' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/heartbeat',
                    'defaults' => array(
                        'controller' => 'TestProject\\V1\\Rpc\\Heartbeat\\Controller',
                        'action' => 'heartbeat',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'test-project.rpc.heartbeat',
        ),
    ),
    'zf-rpc' => array(
        'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => array(
            'service_name' => 'Heartbeat',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'test-project.rpc.heartbeat',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => array(
                0 => 'application/vnd.test-project.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => array(
                0 => 'application/vnd.test-project.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'TestProject\\V1\\Rpc\\Heartbeat\\Controller' => array(
                'actions' => array(
                    'heartbeat' => array(
                        'GET' => true,
                        'POST' => false,
                        'PATCH' => false,
                        'PUT' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
);
