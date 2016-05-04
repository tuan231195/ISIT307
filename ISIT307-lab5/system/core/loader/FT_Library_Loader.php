<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class FT_Library_Loader
{
    /**
     * Load library
     *
     * @param   string
     * @param   array
     * @desc    hàm load library, tham số truyền vào là tên của library và
     *          danh sách các biến trong hàm khởi tạo (nếu có)
     */
    public function load($library, $agrs = array())
    {
        // Nếu thư viện chưa được load thì thực hiện load
        if ( empty($this->{$library}) )
        {
            // Chuyển chữ hoa đầu và thêm hậu tố _Library
            $class = ucfirst($library) . '_Library';
            require_once(PATH_SYSTEM . '/library/' . $class . '.php');
            $this->{$library} = new $class($agrs);
        }
    }
}