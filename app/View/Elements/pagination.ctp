<?php $this->Paginator->options(array('url' =>  $this->request->query));?>
<div class="dataTables_info" id="DataTables_Table_0_info">
    <?php echo $this->Paginator->counter(array('format' => __('Displaying ') . ' %start%-%end% ' . __('of ') . '%count% ' . __('entries'))); ?>
</div>
<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_0_paginate">
    <?php echo $this->Paginator->first('First ', array('disabledTag' => 'a', 'tag' => '', 'class' => 'prev')); ?>
    <?php echo $this->Paginator->prev('Previous ', array('disabledTag' => 'a', 'tag' => '', 'class' => 'prev')); ?>
    <span>
        <?php echo $this->Paginator->numbers(array('currentTag' => 'span', 'tag' => '', 'separator' => '', 'currentClass' => 'paginate_active')); ?>
    </span>
    <?php echo $this->Paginator->next('Next ', array('disabledTag' => 'a', 'tag' => '', 'class' => 'prev')); ?>
    <?php echo $this->Paginator->last('Last ', array('disabledTag' => 'a', 'tag' => '', 'class' => 'prev')); ?>
</div>
<style>
    #DataTables_Table_0_paginate span span {
        background: none repeat scroll 0 0 #368ee0;
        color: #fff;
        cursor: pointer;
        margin-right: 5px;
        padding: 3px 8px;
        text-decoration: none;
    }
</style>