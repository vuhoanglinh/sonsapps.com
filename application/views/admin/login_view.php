<link href="<?php echo base_url(); ?>themes/css/css.css" rel="stylesheet">

<script type="text/javascript">
	$(document).ready(function(){
		$('body').addClass('login');
	});
</script>
<!--Profile container-->
    <div id="myModal" class="modal">
      <div class="modal-header">
        <h3 id="myModalLabel">Administrator</h3>
      </div>
      <div class="modal-body">
        <?php echo form_open('admin/action/checklogin', array('id' => 'frm','novalidate' => 'novalidate')); ?>
          <label for="txtUsername" style="color: #D8000C"></label> 
          <input type="text" id="txtUsername" name="txtUsername" placeholder="Username" maxLength="255">
          <label for="txtPassword" style="color: #D8000C"></label>
          <input type="password" id="txtPassword" name="txtPassword" placeholder="Password" maxLength="255">
          <br/>
          <button type="submit" class="btn btn-large"><i class="icon-paper-plane"></i> Đăng nhập</button>
          <img id="loading" style="display: none;" src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /><br />
          <label id="message" style="display: none; color: #D8000C; margin-top: 5px;"></label>
        <?php echo form_close(); ?>
      </div>
    </div>
    <!--END: Profile container-->

    <script type="text/javascript">
    	$(document).ready(function(){
            function checknull()
            {
                var $bool               =   false;
                var $message_null       =   "Bạn phải nhập thông tin này.";
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
				
				var from = $(this);
                    if(checknull())
                    {
                        $.ajax({
						url: from.attr('action'),
						type: from.attr('method'),
						data: $(from).serialize(),
						beforeSend : function (){
							$("#loading").show();
						},
						success: function(data) {	
							$('#message').show();
							if(data == '1')
							{			
								setTimeout(function () {
									$('#message').html('Đăng nhập thành công');
			                		window.location.href = "<?php echo base_url(); ?>admin/index.html";
					            }, 500);
								
							}
							else
							{								
								setTimeout(function () {										
									$('#message').html('Đăng nhập thất bại');																	
			                		$("#loading").hide();
					            }, 500);
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {	                	
	                	setTimeout(function () {
	                		$("#loading").hide();
			            }, 500);

	                }
					});   
                    }					

					return false;

			});
    	});
    </script>
