<?php defined('SYSPATH') or die('No direct script access.');

class Mysite_Paginator_Type_Orm extends Mysite_Paginator_Type
{

    protected function _get_count ()
    {
        if ($this->_count == null) {
            $this->_count = $this->object_list
                                 ->reset(false)
                                 ->count_all();
        }
        return $this->_count;
    }
}
