<?php defined('SYSPATH') or die('No direct script access.');

class Mysite_Paginator_Page_Orm extends Mysite_Paginator_Page
{

    protected function get_object_list ()
    {
        return $this->paginator->object_list->reset(false)
                    ->limit($this->_limit)
                    ->offset($this->_offset)
                    ->find_all()
                    ->as_array();
    }
    
}