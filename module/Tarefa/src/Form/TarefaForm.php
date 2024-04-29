<?php

namespace Tarefa\Form;

use Zend\Form\Form;

class TarefaForm extends Form
{
    public function __construct()
    {
        parent::__construct('tarefa', []);
        $this->add(new \Zend\Form\Element\Hidden('id'));
        $title = (new \Zend\Form\Element\Text("title", ['label' => "Title"]));
        $title->setAttributes(['placeholder' => 'Titulo']);
        $this->add(new \Zend\Form\Element\Textarea("desc", ['label' => "desc"]));
        $date = new \Zend\Form\Element\Hidden("date");
        $date->setAttributes(['value' => ''.date("Y-m-d").'']);
        $this->add($date);
        $this->add($title);
        $select = (new \Zend\Form\Element\Select("status"));
        $select->setValueOptions([
            'Pendente' => 'Pendente',
            'Progresso' => 'Em progresso',
            'Concluida' => 'Concluida',
        ]);
        $this->add($select);
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['value' => 'salvar', 'id' => 'submit']);
        $this->add($submit);
    }
}