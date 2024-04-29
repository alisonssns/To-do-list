<?php

namespace Tarefa\Model;

class Tarefa implements \Zend\Stdlib\ArraySerializableInterface
{

    private $id;
    private $title;
    private $desc;
    private $date;
    private $status;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data["id"]) ? $data['id'] : null;
        $this->title = !empty($data["title"]) ? $data['title'] : null;
        $this->desc = !empty($data["desc"]) ? $data['desc'] : null;
        $this->date = !empty($data["date"]) ? $data['date'] : null;
        $this->status = !empty($data["status"]) ? $data['status'] : null;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitle(){return $this->title;}
    public function setTitl($title){$this->title = $title;}

    public function getDesc(){return $this->desc;}
    public function setDesc($desc){$this->desc = $desc;}

    public function getDate(){return $this->date;}
    public function setDate($date){$this->date = $date;}

    public function getStatus(){return $this->status;}
    public function setStatus($status){$this->status = $status;}

    public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'date' => $this->date,
            'status' => $this->status,
        ];
    }

}