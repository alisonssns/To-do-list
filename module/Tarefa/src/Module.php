<?php

namespace Tarefa;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Tarefa\Controller\TarefaController;

class Module implements ConfigProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\TarefaTable::class => function ($container) {
                    $TableGateway = $container->get(Model\TarefaTableGateway::class);
                    return new Model\TarefaTable($TableGateway);
                },
                Model\TarefaTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Tarefa());
                    return new TableGateway('tarefa', $dbAdapter, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                TarefaController::class => function ($container) {
                    $tableGateway = $container->get(Model\TarefaTable::class);
                    return new TarefaController($tableGateway);
                },
            ]
        ];
    }

}
