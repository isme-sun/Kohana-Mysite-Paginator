<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * 分页类
 *
 * @package Mysite/Paginator
 * @category page
 * @author isme.sun@mysite
 */
abstract class Mysite_Paginator_Page extends ArrayObject
{
    // 分页类
    protected $_paginator = null;
    
    // 当前页
    protected $_number = null;
    
    // 页码范围
    protected $_page_range = null;
    
    // 最总分页数据对象
    protected $_object_list = null;

    protected $_limit = null;

    protected $_offset = null;

    public function __construct ($paginator, $number, $limit, $offset)
    {
        $this->_paginator = $paginator;
        
        $this->_limit = $limit;
        $this->_offset = $offset;
        
        if ($number > $this->paginator->num_pages) {
            $number = $this->paginator->num_pages;
        } elseif ($number < 1) {
            $number = 1;
        }
        
        $this->_number = $number;
        parent::__construct($this->object_list);
    }

    abstract protected function get_object_list ();

    /**
     * 是否有下一页
     *
     * @return boolean
     */
    public function has_next ()
    {
        return $this->number < $this->paginator->num_pages;
    }

    /**
     * 是否有上一页
     */
    public function has_previous ()
    {
        return $this->number > 1;
    }

    /**
     * 是偶有其他页面
     *
     * @return boolean
     */
    public function has_other_pages ()
    {
        return ($this->has_next() or $this->has_previous());
    }

    /**
     * 下一页 页码数
     */
    public function next_page_number ()
    {
        return $this->has_next() ? $this->number + 1 : $this->number;
    }

    /**
     * 上一页 页码数
     */
    public function previous_page_number ()
    {
        return $this->has_previous() ? $this->_number - 1 : $this->_number;
    }

    /**
     * 分页导航条渲染
     *
     * @param unknown_type $view            
     */
    public function render ($view = NULL)
    {
        $view = ($view !== NULL) ? $view : 'paginator/default';
        return View::factory()->bind('page', $this)->render($view);
    }

    public function __toString ()
    {
        return $this->render();
    }

    /**
     * 其实页码数
     */
    public function start_index ()
    {
        if ($this->paginator->count == 0) {
            return 0;
        }
        return ($this->paginator->per_page * ($this->number - 1)) + 1;
    }

    /**
     * 结束页码数
     */
    public function end_index ()
    {
        if ($this->number == $this->paginator->num_pages) {
            return $this->paginator->count;
        }
        return $this->number * $this->paginator->per_page;
    }

    public function __get ($name)
    {
        if ($name == 'number') {
            return $this->_number;
        } elseif ($name == 'paginator') {
            return $this->_paginator;
        } elseif ($name == 'object_list') {
            if ($this->_object_list == null) {
                $this->_object_list = $this->get_object_list();
            }
            return $this->_object_list;
        }
    }

    public function current_range ()
    {
        
        $num_pages = $this->paginator->num_pages;
        
        $page_range = $this->paginator->page_range;
        
        if ($num_pages <= 9) 
        {
            $range = $page_range;
        } 
        else 
        {
            if ($this->number <= 5) 
            {
                $range = array_slice($page_range, 0, 9);
            } elseif (($num_pages - $this->number) < 5) {
                $range = array_slice($page_range, - 9);
            } 
            else 
            {
                $start = $this->number - 5;
                $range = array_slice($page_range, $start, 9);
            }
        }
        
        return $range;
    }
    
    public function url($number) 
    {
        
        static $url = null;
        if ($url == null) 
        {
            $url = Request::current()->url();
        }
        
        $query = URL::query(array(
            $this->paginator->key => $number,
        ));
        
        echo URL::site($url.$query);
    }
    
}