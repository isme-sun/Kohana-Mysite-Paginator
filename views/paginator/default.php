<?php I18n::load('paginator/');?>

<?php // <div class="pagination"> ?>
  <ul class="pagination">
  
    <?php if ($page->number == 1):?>
    <li class="disabled">
    <?php else:?>
    <li> 
    <?php endif;?>
      <a href="<?php echo $page->url(1);?>"><?php echo __('first');?></a>
    </li>
  
    <?php if(!$page->has_previous()):?>
    <li class="disabled">
    <?php else:?>
    <li>
    <?php endif;?>
      <a href="<?php echo $page->url($page->previous_page_number());?>"><?php echo __('prev');?></a>
    </li>
  <?php foreach($page->current_range() as $number):?>
    <?php if ($page->number == $number):?>
    <li class="active">
    <?php else:?>
    <li> 
    <?php endif;?>
      <a href="<?php echo $page->url($number);?>"><?php echo $number;?></a>
    </li>
  <?php endforeach;?>
  
   <?php if(!$page->has_next()):?>
   <li class="disabled"> 
   <?php else:?>
   <li>
   <?php endif;?>
      <a href="<?php echo $page->url($page->next_page_number());?>"><?php echo __('next'); ?></a>
    </li>
    <?php if ($page->number == $page->paginator->num_pages):?>
    
    <li class="disabled"> 
    <?php else:?>
    <li>
    <?php endif;?> 
      <a href="<?php echo $page->url($page->paginator->num_pages);?>"><?php echo __('last'); ?></a>
    </li>
  
  </ul>
<?php // </div>?>
