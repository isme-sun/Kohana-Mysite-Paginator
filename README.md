#Paginator for Kohana3.3

这是kohana3.3的标准扩展模块，用于对可分页对象的分页处理.

在接口上模仿了[Django](https://www.djangoproject.com/)的[Paginator](https://docs.djangoproject.com/en/1.5/topics/pagination/)类，
或者说是前者在PHP框架Kohana上的移植.

查看[API](https://github.com/isme-sun/paginator/blob/master/API.md)文档.


------------------------------------------------------------------------------
### DB类 构造查询 

~~~ php
$query = DB::select()->from('articles')
                     ->where('is_published', '=', 1)
                     ->where('category_id', '=', '2');

// 实例化可分页对象
$paginator = Paginator::factory($query, 15);

// 获取指定页面
// 不输入页码参数的话,将自行从当前请求对象中获取,如果也不存在,默认为1
$page = $paginator->page(3);  
~~~

模板输出

~~~ php
<!-- 输出文章标题 -->
<ul>
  <?php foreach($page as $row):?> 
    <li><?php echo $page['title'];?></li>
  <?php endforeach;?>
</ul>
    
<!-- 分页信息 -->
共 <?php $page->paginator->count;?>页 当前第<?php echo $page->number;?>页
<!-- 导航条 -->
<?php echo $page->render();?>;
~~~

### `ORM`对象

~~~ php
$Article = ORM::factory('Blog_Article');
// 使用缺省的分页数量,指定分页目标为ORM
$pagination = Pagination::factory($Article, null, 'orm'); 
$page = $pagination->page();

foreach($page as $row) 
{
    // ORM对象分页集合中的每个条目,依然是ORM类型的对象
    echo $row->title;    
}

echo $page->render('simple');
~~~

------------------------------------------------------------------------------
### 与`DB Build`, `ORM`整合

~~~ php
// DB Build
$page = DB::select()->from('Blog_Articles')
                    ->where('is_published', '=', 1)
                    ->paginator(15, 'default')
                    ->page();
// ORM
$page = ORM::factory('Blog_Articles')
           ->where('is_published', '=', 1)
           ->paginator(15)
           ->page();
~~~

------------------------------------------------------------------------------
### 配置

~~~ php
return array(
    'default' => array(
        'key'      => 'page',               // 导航分页参数  eg. ?page=8
        'theme'    => 'default',            // 导航条皮肤
        'per_page' => 15,                   // 每页数量
        'orphans'  => 5,                    // '孤儿'数量
        'strict'   => FALSE,                // 无效页面的处理方式，false 静默
        'allow_empty_first_page' => TRUE,   // 是否允许首页为空
    ) 
);
~~~

------------------------------------------------------------------------------
### 导航条

在模板中输出

~~~ php
<?php echo $page;?>
<?php echo $page->render('youtheme'); ?>
~~~

缺省的的导航条以Bootstrap的[Pagination](http://twitter.github.io/bootstrap/components.html#pagination)
组件结构为准,如果项目中引用了Bootstrap,可以直接使用.

`Bootstrap3`的导航组件class直接写在ul元素上，目前缺省的导航条`class`为`pagination`

## TODO

- 导航条的输出优化
- 提供一套简单导航条模板
- 完善注释

------------------------------------------------------------------------------
