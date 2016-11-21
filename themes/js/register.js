

	function checkUsername($url, $message_null, $message_error)
	{
		var bool 	=	false;
		var $username 	=	$('#txtUsername');
		
		if($username.val() == "")
		{
			$("label[for='txtUsername']").html($message_null);
			$username.parent().addClass('error');
		}
		else
		{
			if($username.val().length >= 3 && $username.val().length <= 30)
			{
				console.log('success');
				$.ajax({
	                type: "POST",
	                url: $url,
	                data: { 'username' : $username.val()},
	                success: function(msg){
	                	if(msg == '1'){
	                		$("label[for='txtUsername']").html('');
							$username.parent().removeClass('error');
							bool 	=	true;
	                	}
	                	else
	                	{
	                		$("label[for='txtUsername']").html($message_error);
							$username.parent().addClass('error');
	                	}
	                }
	            });
			}
			else
			{
				console.log('error');
				$("label[for='txtUsername']").html('');
				if(!$username.parent().hasClass('error'))
				{
					$username.parent().addClass('error');
				}
			}			
		}
		return bool;
	}

