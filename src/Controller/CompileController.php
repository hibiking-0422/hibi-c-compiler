<?php
namespace App\Controller;

use Cake\Controller\Controller;

class CompileController extends Controller
{
    public function index()
    {
        $this->viewBuilder()->setLayout('compile'); 
    }
}

?>