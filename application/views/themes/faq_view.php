<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>           
            <li class="active"><?php echo $this->lang->line('faq'); ?></li>
        </ul>
    </div>
</div>
<!--Profile container-->
<link href="<?php echo base_url('themes/css/faq.css') ?>" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>themes/js/script_faq.js"></script>
    <div class="container min-height">
	    <div align="center" class="row-fluid">
		       <h2><?php echo $this->lang->line('FaqTitle'); ?></h2>		                
		         <!-- start form login -->
		       	<div id='cssmenu'>
					<ul>
					   <li class='active has-sub'><a href='#'><span><?php echo $this->lang->line('faq1'); ?></span></a>
					   		
						   		<ul>
						   			<?php 
						   				foreach ($faq1 as $row) {
						   					# code...
						   			?>
							         <li class=""><a href='<?php echo base_url('faq').'/'.$row->alias.'/'.$row->id; ?>'><span><?php echo $row->question; ?></span></a>
							         </li>
							        <?php }?>
						     	</ul>
					     
					   </li>
					   <li class='active has-sub'><a href='#'><span><?php echo $this->lang->line('faq2'); ?></span></a>
					      <ul>
					         <ul>
						   			<?php 
						   				foreach ($faq2 as $row) {
						   					# code...
						   			?>
							         <li class=""><a href='<?php echo base_url('faq').'/'.$row->alias.'/'.$row->id; ?>'><span><?php echo $row->question; ?></span></a>
							         </li>
							        <?php }?>
						     	</ul>
					      </ul>
					   </li>	
					   <li class='active has-sub'><a href='#'><span><?php echo $this->lang->line('faq3'); ?></span></a>
					      <ul>
					         <ul>
						   			<?php 
						   				foreach ($faq3 as $row) {
						   					# code...
						   			?>
							         <li class=""><a href='<?php echo base_url('faq').'/'.$row->alias.'/'.$row->id; ?>'><span><?php echo $row->question; ?></span></a>
							         </li>
							        <?php }?>
						     	</ul>
					      </ul>
					   </li>
					   <li class='active has-sub'><a href='#'><span><?php echo $this->lang->line('faq4'); ?></span></a>
					      <ul>
					        <ul>
						   			<?php 
						   				foreach ($faq4 as $row) {
						   					# code...
						   			?>
							         <li class=""><a href='<?php echo base_url('faq').'/'.$row->alias.'/'.$row->id; ?>'><span><?php echo $row->question; ?></span></a>
							         </li>
							        <?php }?>
						     	</ul>
					      </ul>
					   </li>				   
					</ul>
				</div>  
								
		</div>
    </div>
    
    <!--END: Profile container-->