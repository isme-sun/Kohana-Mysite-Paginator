<?php defined('SYSPATH') or die('No direct script access.');

class Mysite_Paginator_Type_Query extends Mysite_Paginator_Type
{

    protected function _get_count ()
    {
        if ($this->_count == null) {
            $object = clone $this->_object_list;
            $object->select(array(
                DB::expr('count(*)'),
                'count'
            ));
            $this->_count = $object->execute()->get('count');
        }
        return $this->_count;
    }
}