<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>           
            <li class="active"><?php echo $this->lang->line('register'); ?></li>
        </ul>
    </div>
</div>
<!--Profile container-->
	<!--<script src="<?php echo base_url(); ?>themes/js/register.js"></script>-->
    <div class="container margin-footer">
	      <div class="row-fluid ">
		    <div class="span6">
		       <h2><?php echo $this->lang->line('register'); ?></h2>
		         <!-- start form login -->
		         	<?php echo form_open(base_url().'action/checkregister', array('id' => 'frm','novalidate' => 'novalidate')); ?>
			          <div class="row-fluid">
			          	<label for="txtName"></label>
			         	<input type="text" id="txtName" name="txtName" placeholder="<?php echo $this->lang->line('message_name'); ?>" maxLength="100">
			          	<label style="margin-bottom: 10px;"><?php echo $this->lang->line('message_register_name'); ?></label>
			          </div>
		              <div class="row-fluid">
                    	<label for="txtUsername"></label>
		              	<input type="text" id="txtUsername" name="txtUsername" placeholder="<?php echo $this->lang->line('message_acount'); ?>" maxLength="100">
			          	<label style="margin-bottom: 10px;"><?php echo $this->lang->line('message_register_account'); ?></label>
			          </div>
			          <div class="row-fluid">
			          	<label for="txtPassword"></label>
			         	<input type="password" id="txtPassword" name="txtPassword" placeholder="<?php echo $this->lang->line('message_password'); ?>" maxLength="30">
			          	<label style="margin-bottom: 10px;"><?php echo $this->lang->line('message_register_password'); ?></label>
			          </div>
								<div class="row-fluid">
									<label for="txtRePassword"></label>
								<input type="password" id="txtRePassword" name="txtRePassword" placeholder="<?php echo $this->lang->line('message_repassword'); ?>" maxLength="30">
									<label style="margin-bottom: 10px;"><?php echo $this->lang->line('message_register_repassword'); ?></label>
								</div>
                        <div class="row-fluid">
			          <input style="height: 48px;" type="text" id="txtPhone" name="txtPhone" placeholder="<?php echo $this->lang->line('message_phone'); ?>" maxLeng="30">
                        <label style="margin: 10px 0;"><?php echo $this->lang->line('message_register_phone'); ?></label>
			             </div>
                      <div class="row-fluid">
			          	<label for="txtEmail"></label>
			          	<input type="text" id="txtEmail" name="txtEmail" placeholder="<?php echo $this->lang->line('message_email'); ?>" maxLeng="255">
			          	<label style="margin-bottom: 10px;"><?php echo $this->lang->line('message_register_email'); ?></label>
			          </div>
                      <div class="row-fluid">
			          	<label for="txtCapcha"></label>
			          	<input type="text" id="txtCapcha" name="txtCapcha" placeholder="<?php echo $this->lang->line('message_capcha'); ?>" maxLeng="255">
                        <label><img id="img_capcha" src="<?php echo $img_capcha ?>" title="<?php echo $this->lang->line('message_capcha'); ?>">
                        <img src="<?php echo base_url('themes/img'); ?>/arrow-refresh-4-icon.png" id="btnCapcha" style="cursor: pointer;" />
                        </label>                         
                        
			          </div>
			          <br/>
			          <button type="submit" id="submit" class="btn btn-large"><i class="icon-paper-plane"></i> <?php echo $this->lang->line('register'); ?></button>
                      <span id="loading1"  style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></span>
                      <input type="hidden" id="capcha" value="<?php echo $code; ?>">
			        <?php echo form_close(); ?>
		    </div>
		<link rel="stylesheet" href="<?php echo base_url('themes/css/intlTelInput.css'); ?>">
        <script src="<?php echo base_url('themes/js/intlTelInput.min.js'); ?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#txtPhone").intlTelInput();
                var capcha = $('#capcha').val();
                //Recapcha
                $('#btnCapcha').on('click', function(){
                    
                    $.ajax({
							url: '<?php echo base_url("home/recapcha"); ?>',
                          	type: 'post',
                            data: 'c=1',
                            dataType: 'json',
                          	success: function(msg){
								$('#img_capcha').attr('src', msg.capcha);
                                $('#capcha').val(msg.code);
                                capcha = msg.code;
                                //console.log(msg.code);
                          	}
				    });                
                });
                
                //Validate Email
                function validateEmail(email) { 
                    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                } 
                
                //Validate Phone
                function validatePhone(txtPhone) {

                    var a = txtPhone;

                    var filter = /^[0-9-+]+$/;

                    if (filter.test(a)) {

                        return true;

                    }

                    else {

                        return false;

                    }

                }

                
				var $message_error_account_exits 		=	"<?php echo $this->lang->line('message_error_account_exits'); ?>"; 
				var $message_null		                =	"<?php echo $this->lang->line('message_null'); ?>";
                var $message_error_email                =   "<?php echo $this->lang->line('message_register_email_error') ?>";
                var $message_error_phone		        =	"<?php echo $this->lang->line('message_phone_error') ?>";
                var $message_error_minlength            =   "<?php echo $this->lang->line('message_error_minlength') ?>";
                var $message_error_maxlength            =   "<?php echo $this->lang->line('message_error_maxlength') ?>";
                var $message_error_capcha               =   "<?php echo $this->lang->line('message_capcha_error')?>";
                var $message_error_repass               =   "<?php echo $this->lang->line('message_repass_error')?>";
                var $message_error_maxlength_phone      =   "<?php echo $this->lang->line('message_error_maxlength_phone')?>";
				function check()
				{
					var bool1, bool2, bool3, bool4, bool5, bool6, bool7 	=	false;
                    
                    //Check capcha
                    if($('#txtCapcha').val() == "")
                    {
                        $("label[for='txtCapcha']").html($message_null);
                        $('#txtCapcha').parent().removeClass('success');
                        $('#txtCapcha').parent().addClass('error');
                        $('#txtCapcha').focus();
                        bool7 	=	false;
                    }                    
                    else
                    {
                        if($('#txtCapcha').val() != capcha)
                        {
                            $("label[for='txtCapcha']").html($message_error_capcha);
                            $('#txtCapcha').parent().removeClass('success');
                            if(!$('#txtCapcha').parent().hasClass('error'))
                            {                                
                                $('#txtCapcha').parent().addClass('error');
                            }
                            $('#txtCapcha').focus();
                            bool7 	=	false;
                        }
                        else
                        {              
                            $("label[for='txtCapcha']").html('');
                            $('#txtCapcha').parent().removeClass('error');
                            $('#txtCapcha').parent().addClass('success');                        
                            bool7 	=	true;
                        }
                    }
                    
                    //Check email
                    if($('#txtEmail').val() == "")
                    {
                        $("label[for='txtEmail']").html($message_null);
                        $('#txtEmail').parent().removeClass('success');
                        $('#txtEmail').parent().addClass('error');
                        $('#txtEmail').focus();
                        bool6 	=	false;
                    }
                    
                    else
                    {
                        if(!validateEmail($('#txtEmail').val()))
                        {
                            $("label[for='txtEmail']").html($message_error_email);
                            $('#txtEmail').parent().removeClass('success');
                            if(!$('#txtEmail').parent().hasClass('error'))
                            {                                
                                $('#txtEmail').parent().addClass('error');
                            }
                            $('#txtEmail').focus();
                            bool6 	=	false;
                        }
                        else
                        {          
                            $("label[for='txtEmail']").html('');
                            $('#txtEmail').parent().removeClass('error');
                            $('#txtEmail').parent().addClass('success');                        
                            bool6 	=	true;
                        }
                    }
                    
                    //Check phone
                    if($('#txtPhone').val() == "")
                    {
                        $("label[for='txtPhone']").html($message_null);
                        $('#txtPhone').parent().removeClass('success');
                        $('#txtPhone').parent().addClass('error');
                        $('#txtPhone').focus();
                        bool5 	=	false;
                    }
                    
                    else
                    {
                        if(!validatePhone($('#txtPhone').val()))
                        {
                            $("label[for='txtPhone']").html($message_error_phone);
                            $('#txtPhone').parent().removeClass('success');
                            if(!$('#txtPhone').parent().hasClass('error'))
                            {                                
                                $('#txtPhone').parent().addClass('error');
                            }
                            $('#txtPhone').focus();
                            bool5 	=	false;
                        }                        
                        else
                        {         
                            $("label[for='txtPhone']").html('');
                            $('#txtPhone').parent().removeClass('error');
                            $('#txtPhone').parent().addClass('success');                        
                            bool5 	=	true;
                        }
                    }
                    
                    
					//Checkrepass
                    if($('#txtRePassword').val() == "")
                    {
                        $("label[for='txtRePassword']").html($message_null);
                        $('#txtRePassword').parent().removeClass('success');
                        $('#txtRePassword').parent().addClass('error');
                        $('#txtRePassword').focus();
                        bool4 	=	false;
                    }
                    else if($('#txtRePassword').val() != $('#txtPassword').val())
                    {
                        $("label[for='txtRePassword']").html($message_error_repass);
                        $('#txtRePassword').parent().removeClass('success');
                        $('#txtRePassword').parent().addClass('error');
                        $('#txtRePassword').focus();
                        bool4 	=	false;
                    }
                    else
                    {
                        $("label[for='txtRePassword']").html('');
                        $('#txtRePassword').parent().removeClass('error');
                        $('#txtRePassword').parent().addClass('success');                        
                        bool4 	=	true;
                    }
                    
                    //Check pass
                    
                    if($('#txtPassword').val() == "")
                    {
                        $("label[for='txtPassword']").html($message_null);
                        $('#txtPassword').parent().removeClass('success');
                        $('#txtPassword').parent().addClass('error');
                        $('#txtPassword').focus();
                        bool3 	=	false;
                    }
                    else if($('#txtPassword').val().length < 3)
                    {
                        $("label[for='txtPassword']").html($message_error_minlength);
                        $('#txtPassword').parent().removeClass('success');
                        $('#txtPassword').parent().addClass('error');
                        $('#txtPassword').focus();
                        bool3 	=	false;
                    }
                    else
                    {
                        $("label[for='txtPassword']").html('');
                        $('#txtPassword').parent().removeClass('error');
                        $('#txtPassword').parent().addClass('success');                        
                        bool3 	=	true;
                    }
                    
                    //check username
                    if($('#txtUsername').val() == "")
                    {
                        $("label[for='txtUsername']").html($message_null);
                        $('#txtUsername').parent().removeClass('success');
                        $('#txtUsername').parent().addClass('error');
                        $('#txtUsername').focus();
                        bool2 	=	false;
                    }
                    else if($('#txtUsername').val().length < 3)
                    {
                        $("label[for='txtUsername']").html($message_error_minlength);
                        $('#txtUsername').parent().removeClass('success');
                        $('#txtUsername').parent().addClass('error');
                        $('#txtUsername').focus();
                        bool2 	=	false;
                    }
                    else
                    {
                        $("label[for='txtUsername']").html('');
                        $('#txtUsername').parent().removeClass('error');
                        $('#txtUsername').parent().addClass('success');                        
                        bool2 	=	true;
                    }
                    
                    //Check name
					if($('#txtName').val() == "")
                    {
                        $("label[for='txtName']").html($message_null);
                        $('#txtName').parent().addClass('error');
                        $('#txtName').parent().removeClass('success');
                        $('#txtName').focus();
                        bool1 	=	false;
                    }
                    
                    else
                    {
                        $('#txtName').parent().removeClass('error');
                        $('#txtName').parent().addClass('success'); 
                        bool1 	=	true;
                    }
                    
					return (bool1 && bool2 && bool3 && bool4 && bool5 && bool6 && bool7);
				}
                                
				function main()
				{
					var form 	=	$('form#frm');
					//if(check())
					//{
						$.ajax({
							url: form.attr('action'),
                          	type: form.attr('method'),
                          	data: form.serialize(),
                          	dataType: 'json',
                            beforeSend : function (){
                                $("#loading1").show();
                            },
                          	success: function(msg){
                                // && msg.result != false
								if(msg.status == '3')
								{
									window.location.href ="<?php echo base_url(); ?>"
								}
                                
                                if(msg.status == '1')
                                {
                                    $("label[for='txtUsername']").html($message_error_account_exits);
                                    $('#txtUsername').parent().removeClass('success');
                                    $('#txtUsername').parent().addClass('error');
                                    $('#txtUsername').focus();
                                }
								console.log(msg.status);
								console.log(msg.result);
								console.log(msg.debug);
                          	}
						});
					//}
				}
				$('form#frm').on('submit', function(){
                    if(check())
                    {                        
					   main();
                    }

					//e.preventDefault();
					return false;
				});
			});
		</script>
		    <div class="span6 text-center">
		    	<img src="<?php echo base_url() ?>/themes/img/mobile-ad.jpg" />
		    </div>
		</div>
    </div>
    <!--END: Profile container-->
