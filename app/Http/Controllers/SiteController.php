<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    protected $t_rep;
    protected $e_rep;
    protected $m_rep;
    protected $template;
    protected $vars;
    protected $contentRightBar = false;
    protected $bar = false;

    public function __construct()
    {

    }

    public function renderOutput()
    {
        return view($this->template)->with($this->vars);
    }

}
