<div id="main">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/dashboards">Dashboard</a>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
            </ul>
            <div class="close-bread">
                    <a href="#">
                            <i class="icon-remove"></i>
                    </a>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3>
                            <i class="icon-th-list"></i>
                            Pages - Listing
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                        <div class="table-holder">
						<table class="table table-hover table-nomargin dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Created on</th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								if(!empty($pages)){
									$num = 1;
									foreach ($pages as $page){
							?>
								<tr>
									<td><?php echo $num?></td>
									<td><?php echo $page['Page']['name']?></td>
                                    <td> <?php echo $page['Page']['created'] ; ?>&nbsp;</td>
                                    <td class="actions">
									<?php 
										echo $this->Html->link($this->Html->Image('view.png'),array('action' => 'view', $page['Page']['id']),array('escape'=>false,'alt' => 'View','title' => 'View'));
										
										echo $this->Html->link($this->Html->Image('editin.png'),array('action' => 'edit', $page['Page']['id']),array('escape'=>false,'alt' => 'Edit','title' => 'Edit'));
									?>		
									</td>
								</tr>
								<?php
									$num++;
									}//end foreach
								}else{
								?>
								<tr>
									<td colspan="5">No Record Found !!!</td>
								</tr>
								<?php
									}
								?>
                            </tbody>
                        </table>
                        
                        </div><?php //echo $this->element('pagination');  ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



