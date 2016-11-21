<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>           
            <li class="active"><?php echo $this->lang->line('login'); ?></li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height">
	      <div class="row-fluid ">
		    <div class="span6">
		       <h2><?php echo $this->lang->line('login'); ?></h2>
		         <!-- start form login -->
		            <?php echo form_open(base_url().'action/checklogin', array('id' => 'frm','novalidate' => 'novalidate')); ?>
			            <?php if($msg != '') {
                            echo "<h3 style='color: red;'>".$msg."</h3>";
                        } ?>
                        <label for="txtUsername" style="color: #D8000C;"></label>      
                        <input type="text" id="txtUsername" name="txtUsername" placeholder="<?php echo $this->lang->line('message_acount'); ?>">
                        <label for="txtPassword" style="color: #D8000C;"></label>
			            <input type="password" id="txtPassword" name="txtPassword" placeholder="<?php echo $this->lang->line('message_password'); ?>">
			          <br/>
			          <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-large"><i class="icon-paper-plane"></i> <?php echo $this->lang->line('login'); ?></button>
			          <label><a href="forgot-password.html"><?php echo $this->lang->line('message_forgot_passord'); ?></a></label>
                      <label id="msg" style="color: red;"></label>
			        <?php echo form_close(); ?>
		    </div>

		    <div class="span2">
		    </div>
		    <div class="span4">
		        <h2 class=""><?php echo $this->lang->line('message_register'); ?></h2>
		        <p class="text-left">
		            <?php echo $this->lang->line('message_info_register'); ?>
			</p>
		        <div class="text-left"><a href="/register.html" class="btn btn-large"><?php echo $this->lang->line('register_account'); ?></a></div>
		    </div>

		</div>
    </div>

    <script type="text/javascript">
    	$(document).ready(function(){
            
            function checknull()
            {
                var $bool               =   false;
                var $message_null       =   "<?php echo $this->lang->line('message_null') ?>";
                var $username           =   $('#txtUsername').val();   
                var $password           =   $('#txtPassword').val();   
                if($username == '')
                {
                    $('label[for="txtUsername"]').html($message_null);
                }
                               
                if($password == '')
                {
                    $('label[for="txtPassword"]').html($message_null);
                }
                
                if($username != '' && $password != '')
                {
                    $bool   = true;
                }
                return $bool;
            }

    		$("form#frm").on('submit', function(){
    			var form 	=	$(this);
                
                if(checknull())
                {
                    $.ajax({
							url: form.attr('action'),
                          	type: form.attr('method'),
                          	data: form.serialize(),
                          	dataType: 'json',
                          	success: function(msg){
								if(msg == '1')
								{
									window.location.href ="<?php echo base_url('login.html'); ?>"
								}
                                else
                                {
                                    $('#msg').html('<?php echo $this->lang->line("message_login_error"); ?>');
                                }
								console.log(msg);
                          	}
						});
                }
    			    

    			return false;			
    		});
    	});
    </script>
    <!--END: Profile container-->
