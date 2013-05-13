<?php defined('SYSPATH') or die('No direct script access.');

class Mysite_Paginator_Page_Query extends Mysite_Paginator_Page
{

    protected function get_object_list ()
    {
        $query = clone $this->paginator->object_list;
        $query->limit($this->_limit)->offset($this->_offset);
        $result = $query->execute();
        return $result->as_array();
    }
}
