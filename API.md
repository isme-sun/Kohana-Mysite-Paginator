# 接口说明

## Paginator

#### Paginator::factory($object_list, $per_page, $type);
初始化一个可分类对象,目前支持的可分类对象为 'query' 和 'orm'

`query`是`DB::select()..` 未执行(`execute`)之前的查询对象

`orm`  是 Koahan的`ORM`的子类 

> $Article = ORM::factory('Blog_Articles');

> $paginator = Paginator::factory($Article, 15, $type='orm');


#### $paginator->count() 
获取分页对象的总数量


#### $paginator->num_pages()
获取分页数量

#### $paginator->page_range()
获取基于1的页码数组

#### $paginator->config($key, $value)
获取所有配置,或某一个指定配置,或给一个配置项赋值

#### $paginator->[confName]
获取某一个配置的值

#### $paginator->page($number)
获取一个分页对象

$number 为空的情况, paginator 以当前http请求的分页参数为依据获取$number值,如果不存在,则为1

> $page = $paginator->page() // 获取当前请求页

## Page

page对象本身是ArrayObject的子类,可用通过数字下标访问具体条目也可以用foreach迭代访问
具体的条目类型根据情况而定, query 的分页结果集是普通数组,orm的分页结果集合依然是orm对象

> $page[5] // 获取第5条数据
> echo count($page)  // 输出本页数量
> echo $page->count()  // 同上
> foreach($page as $row) {
>   echo $row['title']   // orm 的分页里 为 $row->title;
> }


#### $page->start_index
以1为基准的,当前页的开始数字, 例如有100个条目的对象,的第3页的地一个条目的start_index为31

#### $page->end_index
以1为基准的,当前页的最后数字, 例如有100个条目的对象,的第3页的地一个条目的end_index为40

#### $page->has_next()
是否存在下一页

#### $page->has_previous()
是否存在上一页

#### $page->has_other_pages()
是否存在其他的页

#### $page->next_page_number()
下一页的页码数

#### $page->previous_page_number()
上一页的页码数

#### $page->current_range()
当前合理的显示页码范围, 渲染导航条用

#### $page->render($view=null)
渲染输出的导航条, 可一自定义导航条模板,以上方法用来辅助输出导航条













