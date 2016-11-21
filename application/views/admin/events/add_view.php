  <link href="<?php echo base_url(); ?>themes/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>themes/js/moment.js"></script>  
  <script src="<?php echo base_url(); ?>themes/js/bootstrap-datetimepicker.min.js"></script>  
  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/events.html'); ?>">Sự kiện</a> <span class="divider">/</span></li>
            <li class="active">Thêm sự kiện</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <script src="<?php echo base_url('themes/js').'/extention.js'; ?>" type="text/javascript"></script>
    <div class="container min-height">	
      <div class="row-fluid">    
		    <div class="row">
            <div class="span12">
              <div class="span8">
                <h2>Thêm mới sự kiện</h2>
                <?php echo form_open(base_url('admin/action_event/add'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Tiêu đề <span style="color:red">*</span>:</label>
                    <input type="text" id="txtTitle" name="txtTitle" placeholder="Tiêu đề" maxLength="255">
                    <label for="txtTitle"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Alias <span style="color:red">*</span>:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Alias" maxLength="255">
                    <label for="txtAlias"></label>
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Trạng thái:</label>   
                    <input type="radio" id="rdstatus" name="rdstatus" value="1" style="margin-left: 20px;margin: 5px;" checked>Hiện   
                    <input type="radio" id="rdstatus1" name="rdstatus" value="0" style="margin-left: 20px;margin: 5px;">Ẩn                
                  </div>
                  <div class="row-fluid">                 
                    <label>Ngôn ngữ:</label>
                     <select id="slLang" name="slLang" style="padding: 5px;">
                      <option value="vietnamese">Tiếng việt</option>
                      <option value="english">English</option>
                      <option value="indonesia">Indenesia</option>
                      <option value="portugal">Portugal</option>
                      <option value="china">China</option>
                    </select>                         
                  </div>
                  <div class="row-fluid" >                 
                    <label>Thời gian <span style="color:red">*</span>:</label>
                    <input type="text" id="txtTime" name="txtTime" placeholder="Mốc thời gian" maxLength="255">
                  </div>
                 <div class="row-fluid">                 
                    <label>Nội dung:</label>
                     <textarea id="txtContent" name="txtContent" placeholder="Nội dung"></textarea>
                  </div>                
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Thêm</button> <button type="reset" class="btn btn-large" style="margin-right: 10px;"> Hủy</button>
                  <a href="<?php echo base_url('admin/events.html'); ?>" class="btn btn-large">Quay lại</a>
                  <span id="loading1"  style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></span>
                <?php echo form_close(); ?>
              </div>
              <div class="span4 padding">
                <img src="<?php echo base_url(); ?>themes/img/Cloud3.png">
              </div>
            </div>
        </div>
      </div>
    </div>
    <a href="#myModal" id="btnLog" role="button" data-toggle="modal" style="display: none;"></a>
     <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <h3 id="myModalLabel"><i class="icon-mail"></i> Thông báo</h3>
      </div>
      <div class="modal-body">

        <p id="message">Đang tải...</p>
        <p id="loading" style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></p>
        <a href="javascript:void(0)" id="btnclose" class="btn">Đóng </a>
      </div>
    </div>
    <script>
      $('#myModal').modal('hidden');
    </script>

   <script type="text/javascript">
                $(function () {
                  $('#txtTime').datetimepicker({ pickTime: false});
                });
                $(document).ready(function() {   
                  CKEDITOR.replace('txtContent');
                  $('#txtTitle').on('blur keypress',function(){
                        
                      var alias = changetitle($('#txtTitle').val());
                      $('#txtAlias').val(alias);                      
                  });    
                    
                    
                  $("form#frm").on('submit', function(){
                    CKEDITOR.instances['txtContent'].updateElement(); //Updates CKeditor before get value by ajax
                    var from = $(this);
                    if($("#txtTitle").val() == "")
                      {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtTitle").focus();
                        $("#txtTitle").parent().addClass('error');
                        $("label[for='txtTitle']").html($msg);
                      }
                      else if($("#txtAlias").val() == "") {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtAlias").focus();
                        $("#txtAlias").parent().addClass('error');
                        $("label[for='txtAlias']").html($msg);
                      }
                    else{
                        $.ajax({
                          url:  from.attr('action'),
                          type: from.attr('method'),
                          data: from.serialize(),
                          dataType: 'json',
                          beforeSend : function (){
                            $("#loading").show();
                            $("#loading1").show();
                          },
                          success: function(data) { 
                              $("#loading").hide();                                   
                              $('p#message').html(data.msg);
                              $('#btnLog').click();  
                              $("#loading1").hide();
                              if(data.status == '2')
                              {
                                    $('#btnclose').click(function() {  
                                    $("#loading").show();                                                        
                                    setTimeout(function () {         
                                        window.location.href = "";
                                    }, 500);
                                  });     
                                  $('.modal-backdrop').click(function() {                               
                                      window.location.href = "";  
                                  });  
                              }
                              else if(data.status == '1'){
                                    var $msg    =   data.msg;
                                    $("#txtTitle").focus();
                                    $("#txtTitle").parent().addClass('error');
                                    $("label[for='txtTitle']").html($msg);
                                  
                                    $('#btnclose').click(function() {  
                                    $("#loading").show();                                                        
                                    setTimeout(function () {         
                                        $('.modal-backdrop').click();
                                    }, 500);
                                  })
                              }
                              else
                              {
                                    $('#btnclose').click(function() {  
                                    $("#loading").show();                                                        
                                    setTimeout(function () {         
                                        $('.modal-backdrop').click();
                                    }, 500);
                                  });
                              }            
                          },
                          error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              $('#btnLog').click(); 
                              $("#loading1").hide();     
                              setTimeout(function () {
                                $("#message").html('Đường truyền gặp sự cố, thao tác không thể thực hiện được.');
                                $("#loading").hide();
                                $('#btnclose').click(function(){
                                   $('.modal-backdrop').click();
                                }); 
                              }, 2000);
                          }
                        });
                    }

                    return false;

                });


                  
              });
    </script>