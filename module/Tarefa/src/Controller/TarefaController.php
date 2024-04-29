<?php

namespace Tarefa\Controller;

use Exception;
use Tarefa\Form\TarefaForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TarefaController extends AbstractActionController
{

    private $table;
    public function __construct($table)
    {
        $this->table = $table;
    }
    public function indexAction()
    {
        $status = $this->params()->fromRoute('status');
    
        $tarefas = $this->table->getAll($status);
    
        return new ViewModel(['tarefas' => $tarefas, 'status' => $status]);
    }
    


    public function addAction()
    {
        $form = new TarefaForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $tarefa = new \Tarefa\Model\Tarefa();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }
        $tarefa->exchangeArray($form->getData());
        $this->table->save($tarefa);
        return $this->redirect()->toRoute('tarefa');
    }
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('tarefa');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del');
            if ($del == 'Deletar') {
                $id = (int) $request->getPost('id');
                $this->table->delete($id);
            }
            return $this->redirect()->toRoute('tarefa');
        }
        return ['id' => $id, 'tarefa' => $this->table->getById($id)];
    }
    public function saveAction()
    {
        return new ViewModel();
    }
    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('tarefa', ['action' => 'adicionar']);
        }
        try {
            $tarefa = $this->table->getById($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('tarefa', ['action' => 'index']);
        }
        $form = new TarefaForm();
        $form->bind($tarefa);
        $form->get('submit')->setAttribute('value', 'save');
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        if (!$request->isPost()) {
            return $viewData;
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }
        $this->table->save($form->getData());
        return $this->redirect()->toRoute('tarefa');
    }

}