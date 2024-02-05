<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MoviesController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store()
    {


        $validation = $this->request()->validate([
            'name' => ['request', 'min:3', 'max:50']
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }


            $this->redirect('/admin/movies/add');
        }

        dd('Validation passed');
    }
}
