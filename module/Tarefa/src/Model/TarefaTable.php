<?php

namespace Tarefa\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class TarefaTable
{

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getAll($status = null)
    {
        if ($status !== null) {
            return $this->tableGateway->select(['status' => $status]);
        } else {
            return $this->tableGateway->select();
        }
    }
    

    public function getById($id)
    {
        $id = (int) $id;
        $rowSet = $this->tableGateway->select(['id' => $id]);
        $row = $rowSet->current();
        if (!$row) {
            throw new RuntimeException(sprintf("não encontrado o id %d", $id));
        }
        return $row;
    }

    public function save(Tarefa $tarefa)
    {

        $data = [
            'id' => $tarefa->getId(),
            'title' => $tarefa->getTitle(),
            'desc' => $tarefa->getDesc(),
            'date' => $tarefa->getDate(),
            'status' => $tarefa->getStatus(),
        ];

        $id = (int) $tarefa->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }

}