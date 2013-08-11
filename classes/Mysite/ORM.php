<?php
class Mysite_ORM extends Kohana_ORM
{
    
    public function paginator($per_page=null, $config='default')
    {
        return Paginator::factory($this, $per_page, 'orm', $config);
    }
    
}
