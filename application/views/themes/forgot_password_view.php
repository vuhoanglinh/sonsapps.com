 	<!--Profile container-->
    <div class="container min-height">
	      <div class="row-fluid ">
		    <div class="span6">
		       <h2><?php echo $this->lang->line('reset_pass'); ?></h2>		                
		         <!-- start form login -->
		             <form action="" method="post">
		              <label><?php echo $this->lang->line('message_email_reset'); ?></label>
			          <input type="text" placeholder="<?php echo $this->lang->line('message_email_reset'); ?>">			        
			          <br/>
			          <button type="submit" class="btn btn-large"><i class="icon-paper-plane"></i> <?php echo $this->lang->line('reset'); ?></button>
			    
			        </form>		        
		    </div>
		    
		    <div class="span6 text-center">
		    </div>

		</div>
    </div>
    <!--END: Profile container-->