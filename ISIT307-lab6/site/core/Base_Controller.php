<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Base_Controller extends FT_Controller
{
    // không cần gọi đến $this->view->show nữa
    public function __destruct()
    {
        $this->view->show();
    }
}