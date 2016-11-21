  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<?php 
     foreach($arr_project as $project) {
?>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application/project'); ?>">Project</a> <span class="divider">/</span></li>
            <li class="active"><?php echo $project->Name; ?></li>
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
                <h2>Chỉnh sửa project</h2>
                
                <?php echo form_open(base_url('admin/action_project/edit_project'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Tên project <span style="color:red">*</span>:</label>
                    <input type="text" id="txtName" name="txtName" value="<?php echo $project->Name; ?>" placeholder="Tên project" maxLength="255">
                    <label for="txtName"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Tên không dấu <span style="color:red">*</span>:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Tên không dấu" value="<?php echo $project->alias; ?>" maxLength="255">
                    <label for="txtAlias"></label>
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Trạng thái:</label>   
                    <input type="radio" id="rdstatus" name="rdlocked" <?php echo ($project->locked == 1) ? 'checked' : ''; ?> value="1" style="margin-left: 20px;margin: 5px;" checked>Hoạt động  
                    <input type="radio" id="rdstatus1" name="rdlocked" <?php echo ($project->locked == 0) ? 'checked' : ''; ?> value="0" style="margin-left: 20px;margin: 5px;">Tạm ngưng                
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Kích hoạt admod:</label>   
                    <input type="radio" id="rdstatus" name="rdAdmod" value="1" <?php echo ($project->activeAdmob == 1) ? 'checked' : ''; ?> style="margin-left: 20px; margin: 5px;">Kích hoạt   
                    <input type="radio" id="rdstatus1" name="rdAdmod" value="0" <?php echo ($project->activeAdmob == 0) ? 'checked' : ''; ?> style="margin-left: 20px; margin: 5px;">Chưa kích hoạt                
                  </div>                  
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Cập nhật</button> <button type="reset" class="btn btn-large"  style="margin-right: 10px;"> Hủy</button>
                  <a href="<?php echo base_url('admin/application/project'); ?>" class="btn btn-large">Quay lại</a>
                  <span id="loading1"  style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></span>
                  <input type="hidden" name="projectId" value="<?php echo $project->projectId; ?>">
                  <input type="hidden" id="projectName" name="projectName" value="<?php echo $project->Name; ?>">
                <?php echo form_close(); ?>                
              </div>
              <div class="span4 padding">
                <img src="<?php echo base_url(); ?>themes/img/Cloud3.png">
              </div>
            </div>
        </div>
      </div>
    </div>
<?php 
    break;
   } //EndForeach
?>
    <a href="#myModal" id="btnLog" role="button" data-toggle="modal" style="display: none;"></a>
     <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <h3 id="myModalLabel"><i class="icon-mail"></i> Thông báo</h3>
      </div>
      <div class="modal-body">

        <h3>Thông tin Project</h3>
        <p id="message">Đang tải...</p>
        <p id="loading" style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></p>
        <a href="javascript:void(0)" id="btnclose" class="btn btn-large">Đóng </a>
      </div>
    </div>
    <script>
      $('#myModal').modal('hidden');
    </script>

   <script type="text/javascript">
              
                $(document).ready(function() {   
                  $('#btnclose').click(function() {  
                    $("#loading").show();                                                        
                    setTimeout(function () {                             
                      $('.modal-backdrop').click();
                    }, 500);
                  });     
                  $('#btnLog').click(function() {  
                  });
                  
                  $('#txtName').on('keypress blur',function(){
                        
                          var alias = changetitle($('#txtName').val());
                          $('#txtAlias').val(alias);                      
                 });      
                    
                  $("form#frm").on('submit', function(){
                      if($("#txtName").val() == "")
                      {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtName").parent().addClass('error');
                        $("label[for='txtName']").html($msg);
                      }
                      else if($("#txtAlias").val() == "") {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtAlias").parent().addClass('error');
                        $("label[for='txtAlias']").html($msg);
                      }
                      else
                      {
                        var from = $(this);

                        $.ajax({
                          url: from.attr('action'),
                          type: from.attr('method'),
                          data: from.serialize(),
                          dataType: 'json',
                          beforeSend : function (){
                            $("#loading").show();
                            $("#loading1").show();
                          },
                          success: function(data) {   
                            if(data.status == '1')  
                            {     
                              $('#btnLog').click();
                              $("#message").html(data.msg);
                              $('#projectName').val($('#txtName').val());
                            }   
                            else
                            {
                              $("#txtName").parent().addClass('error');
                              $("#txtName").focus();
                              $("label[for='txtName']").html(data.msg);
                            }                              
                              $("#loading").hide();
                              $("#loading1").hide();
                          },
                          error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              $('#btnLog').click();      
                              setTimeout(function () {
                                $("#message").html('Đường truyền gặp sự cố, thao tác không thể thực hiện được.');
                                $("#loading").hide();
                                $('#btnclose').click(function(){
                                  $('.close').click();
                                }); 
                              }, 500);
                          }
                        });
                      }
                      
                    return false;

                });


                  
              });
    </script>