<!--Profile container-->
<?php 
	foreach ($faq as $row) {
	
?>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>           
            <li><a href="<?php echo base_url('faq.html'); ?>"><?php echo $this->lang->line('faq'); ?></a> <span class="divider">/</span></li>           
            <li class="active"><?php echo $row->question; ?></li>
        </ul>
    </div>
</div>
    <div class="container min-height">
	    <div class="row-fluid">
	    	<h2 class="text-center"><?php echo $row->question; ?></h2>
	    	<div class="span12">
	    		<?php echo $row->answer; ?>
	    	</div>
		</div>
    </div>
    <!--END: Profile container-->
<?php } //End foreach ?>