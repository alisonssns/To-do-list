<?php

namespace Tarefa;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'tarefa' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/tarefa[/:action[/:id]][/:status]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'status' => '[a-zA-Z]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\TarefaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            // Controller\TarefaController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'tarefa' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'developertest',
        'username' => 'root',
        'password' => '1234',
        'hostname' => 'localhost'
    ]
];
