<?php $this->Paginator->options(array('url' =>  $this->request->query));?>
<div class="btn-group text hidden-768">
   <span> 
       <?php 
       echo $this->Paginator->counter(
                array('format' => __('') . '<strong> %start%-%end% </strong>' . __('of ') . '<strong> %count%  </strong> ' . __(' '))
            ); ?>
   </span>
</div>

<div class="btn-group">
    <?php echo $this->Paginator->prev('Prev', array('disabledTag' => 'a', 'tag' => 'span', 'class' => 'btn ajax-pagination')); ?>
</div> 
<div class="btn-group">    
    <?php //echo $this->Paginator->numbers(array('currentTag' => 'span', 'tag' => '', 'separator' => '', 'currentClass' => 'paginate_active')); ?>
    <?php echo $this->Paginator->next('Next', array('disabledTag' => 'a', 'tag' => 'span', 'class' => 'btn ajax-pagination')); ?>
</div>
