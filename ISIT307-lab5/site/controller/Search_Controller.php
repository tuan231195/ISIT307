<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 11/04/2016
 * Time: 9:35 AM
 */

class Search_Controller extends Base_Controller
{
    public function searchAction()
    {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $data['title'] = "Search";
            $this->view->load("search", $data);
        }
        else{
            $criteria = $_POST['criteria'];
            switch($criteria){
                case "professor":
                    header("Location:?a=professor&keyword={$_POST['keyword']}");
                    break;
                case "school":
                    header("Location:?keyword={$_POST['keyword']}");
                    break;
                case "course":
                    header("Location:?a=course&keyword={$_POST['keyword']}");
            }
        }

    }

}