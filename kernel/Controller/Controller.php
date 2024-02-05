<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Redirect;
use App\Kernel\View\View;
use App\Kernel\Http\Request;

abstract class Controller
{
    private View $view;

    private Request $request;

    private Redirect $redirect;

    public function view(string $name)
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url) {
        return $this->redirect->to($url);
    }

}