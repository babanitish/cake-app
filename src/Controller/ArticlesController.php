<?php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent

        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    public function view($slug = null){
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));

    }
    public function add()
    {
    $article = $this->Articles->newEmptyEntity();
    
    if($this->request->is('post')){
    $article = $this->Articles->patchEntity($article,$this->request->getData());

        if($this->Articles->save($article)){
            $this->Flash->success('your article has been saved');
            $this->redirect(['action' => 'index']);
        }
        $this->Flash->error('unable to add your article');
    }
    $this->set(compact('article'));
    }
    public function edit($slug){
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        if($this->request->is(['post','put'])){
            $article = $this->Articles->patchEntity($article,$this->request->getData());
        
                if($this->Articles->save($article)){
                    $this->Flash->success('your article has been updated');
                    $this->redirect(['action' => 'index']);
                }
                $this->Flash->error('unable to update your article');
            }
            $this->set(compact('article'));
    }
    public function delete($slug){
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if($this->Articles->delete($article)){
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}
