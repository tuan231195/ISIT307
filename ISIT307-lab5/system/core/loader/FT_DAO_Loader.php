<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 10/04/2016
 * Time: 10:18 AM
 */

class FT_DAO_Loader
{
    public function load($dao)
    {
        // Nếu thư viện chưa được load thì thực hiện load
        if (empty($this->{$dao})) {
            // Chuyển chữ hoa đầu và thêm hậu tố _Library
            $class = ucfirst($dao) . '_DAO';
            require_once(PATH_APPLICATION . '/dao/BASE_DAO.php');
            require_once(PATH_APPLICATION . '/dao/' . $class . '.php');
            return new $class();
        }
    }
}