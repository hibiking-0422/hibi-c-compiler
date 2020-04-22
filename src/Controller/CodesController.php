<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class CodesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $codes = $this->Paginator->paginate($this->Codes->find());
        $this->set(compact('codes'));
    }

    public function view($id = null)
    {
        $code = $this->Codes->findById($id)->firstOrFail();
        $this->set(compact('code'));
    }

    public function add()
    {
        $this->viewBuilder()->setLayout('compile'); 
        $code = $this->Codes->newEmptyEntity();
        if ($this->request->is('post')) {
            $code = $this->Codes->patchEntity($code, $this->request->getData());

            if ($this->Codes->save($code)) {
                $this->Flash->success(__('Your code has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your code.'));
        }
        $this->set('code', $code);
    }

    public function edit($id)
    {
        $code = $this->Codes->findById($id)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Codes->patchEntity($code, $this->request->getData());
            if ($this->Codes->save($code)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your code.'));
        }

        $this->set('code', $code);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $code = $this->Codes->findById($id)->firstOrFail();
            if ($this->Codes->delete($code)) {
                $this->Flash->success(__('The {0} code has been deleted.', $code->title));
                return $this->redirect(['action' => 'index']);
        }
    }
}
