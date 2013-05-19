<?php defined('SYSPATH') or die('No direct script access.');

abstract class Database_Query_Builder extends Kohana_Database_Query_Builder
{
    public function paginator($per_page=null, $config='default')
    {
        return Paginator::factory($this, $per_page, 'query', $config);
    }
}

