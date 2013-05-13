<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 分页类 提供对可分页对象的分页访问方法，是Python的Web框架Django自带分类页类的PHP实现
 * 
 * #### 示例一:  对Kohana DB的 Query_Build分页处理
 * 
 *     $query = DB::select()->from('articles')
 *                            ->where('is_published', '=', 1)
 *     $paginator = Paginator::factory($query, 15);
 *     $page = $paginator->page(2);
 *     
 * #### 示例二:  对Kohana ORM对象分页处理,使用默认分页数
 *     $Article = ORM::factory('Blog_Article');
 *     $Article->where('is_del', '=', 0);
 *     $paginator = Paginator::factory($Article, null, 'orm');
 *     
 * #### 模板输出
 * 
 *     <?php foreach($page as $row):?>
 *         echo $row['title'].'<br />';
 *     <?php endforeach;?>
 *     
 *     echo $page; // 输出导航页
 *
 * 该类之可以通过工厂方法获取分页实例
 * 
 * @package Mysite/Paginator
 * @author isme.sun
 */
abstract class Paginator extends Mysite_Paginator_Type
{
}