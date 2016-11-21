  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
 <?php foreach ($arr_app as $app) {
                  # code...
                ?>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li class="active"><?php echo  $app->projectName; ?></li>
        </ul>
    </div>
</div>
<script src="<?php echo base_url('themes/js').'/extention.js'; ?>" type="text/javascript"></script>

<!--Profile container-->
    <div class="container min-height">	
      <div class="row-fluid">    
		    <div class="row">
            <div class="span12">
              <div class="span8">
                <h2>Chỉnh sửa thông tin app</h2>
               
                <?php echo form_open(base_url('admin/action_project/edit_app'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Project:</label>
                    <select id="slProject" name="slProject" style="padding: 5px;">
                      <?php foreach ($arr_project as $row) {
                        # code...
                      ?>
                      <option value="<?php echo $row->projectId; ?>" <?php echo ($app->projectId == $row->projectId) ? 'selected' : ''; ?>><?php echo $row->Name; ?></option>
                      <?php } ?>
                    </select>                         
                  </div>
                  <div class="row-fluid">                 
                    <label>Package Name <span style="color:red">*</span>:</label>
                    <input type="text" id="txtId" name="txtId" placeholder="Package Name" maxLength="255" value="<?php echo $app->packageName; ?>">
                    <label for="txtId"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Thư mục chứa ứng dụng <span style="color:red">*</span>:</label>
                    <input type="text" id="txtFolder" name="txtFolder" placeholder="Thư mục" maxLength="255" value="<?php echo $app->folder; ?>">
                    <label for="txtFolder"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Link ứng dụng mẫu:</label>
                    <input type="text" id="txtLink" name="txtLink" placeholder="Link ứng dụng mẫu" maxLength="255" value="<?php echo $app->linkAppModel; ?>">
                    <label for="txtLink"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Logo:</label>
                    <input type="text" id="txtImage" name="txtImage" style="width: 60%;" placeholder="Hình ảnh ứng dụng" maxLength="255" value="<?php echo $app->logo; ?>"><span class="add-on">
                    <button type="button" id="btnImage" class="btn" style="margin-bottom: 10px;"><img src="<?php echo base_url(); ?>themes/img/Arrow-upload-2-icon.png" /></button>                        
                  </div>
                  <div class="row-fluid">                 
                    <label>Hình thức phát hành:</label>
                    <input type="text" id="txtForms" name="txtForms" placeholder="Hình thức phát hành" maxLength="255" value="<?php echo $app->forms; ?>">                         
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Trạng thái:</label>   
                    <input type="radio" id="rdstatus" name="rdstatus" value="1" style="margin-left: 20px;margin: 5px;" <?php echo ($app->status == 1) ? 'checked' : ''; ?>>Hoạt động   
                    <input type="radio" id="rdstatus1" name="rdstatus" value="0" style="margin-left: 20px;margin: 5px;" <?php echo ($app->status == 0) ? 'checked' : ''; ?>>Tạm ngưng                
                  </div>
                  <div class="row-fluid">                 
                    <label>Ngôn ngữ:</label>
                    <select id="slLang" name="slLang" style="padding: 5px;">
                      <option value="vietnamese" <?php echo ($app->language == "vietnamese") ? 'selected' : ''; ?>>Tiếng việt</option>
                      <option value="english" <?php echo ($app->language == "english") ? 'selected' : ''; ?>>English</option>
                      <option value="indonesia" <?php echo ($app->language == "indonesia") ? 'selected' : ''; ?>>Indenesia</option>                      
                      <option value="portugal" <?php echo ($app->language == "portugal") ? 'selected' : ''; ?>>Portugal</option>
                      <option value="china" <?php echo ($app->language == "china") ? 'selected' : ''; ?>>China</option>
                    </select>                         
                  </div>
                  <div class="row-fluid">                 
                    <label>Mô tả ngắn:</label>
                    <textarea rows="3" id="txtShortDescription" name="txtShortDescription" maxLength="500" style="width:80%"><?php echo $app->short_description; ?></textarea>
                  </div>
                  <div class="row-fluid">                 
                    <label>Mô tả:</label>
                    <textarea id="txtDescription" name="txtDescription" rows="3" style="width:80%"><?php echo $app->description; ?></textarea>
                  </div>
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Cập nhật</button> <button type="reset" id="reset" style="margin-right: 10px;" class="btn btn-large"> Hủy</button>
                  <a href="<?php echo base_url('admin/application'); ?>" class="btn btn-large">Quay lại</a>
                  <input type="hidden" id="oldfolder" name="oldfolder" value="<?php echo $app->folder; ?>">
                  <input type="hidden" id="oldpackage" name="id" value="<?php echo $app->packageName; ?>">
                  <input type="hidden" id="id" name="id" value="<?php echo $app->id; ?>">
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
                  } //Endforeach?>
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
               CKEDITOR.replace('txtDescription');
                $(document).ready(function() { 
                  
                  $('#txtFolder').on('blur',function(){
                        
                      var alias = changetitle($('#txtFolder').val());
                      $('#txtFolder').val(alias);                      
                  }); 

                  $('#btnclose').click(function() {  
                    $("#loading").show();                                                        
                    setTimeout(function () {                             
                      $('.modal-backdrop').click();
                    }, 500);
                  });     
                  $('.modal-backdrop').click(function() {  
                  });

                  function SetFileField(fileUrl) {
                    jQuery('#txtImage').val(fileUrl);
                  } 
                  $("#btnImage").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
                  }); 

                  $("form#frm").on('submit', function(){
                  CKEDITOR.instances['txtDescription'].updateElement(); //Updates CKeditor before get value by ajax
                  var from = $(this);
                  if($('#txtId').val() == "")
                  {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtId").parent().addClass('error');
                        $("#txtId").focus();
                        $("label[for='txtId']").html($msg);
                  }
                  else if($('#txtFolder').val() == "")
                  {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtFolder").parent().addClass('error');
                        $("#txtFolder").focus();
                        $("label[for='txtFolder']").html($msg);
                  }
                  else
                  {
                    $.ajax({
                      url: from.attr('action'),
                      type: from.attr('method'),
                      data: from.serialize(),
                      dataType: 'json',
                      beforeSend : function (){
                        $("#loading").show();
                      },
                      success: function(data) { 
                        if(data.status == '1')
                        {               
                          var message   = data.msg;
                          $("#message").html(message);
                          $("#loading").hide();                        
                          $('#btnLog').click();  
                          $('#id').val($('#txtId').val());
                        }
                        else if(data.status == '2')
                        {
                          var message   = data.msg;
                          $("#message").html(message);
                          $("#loading").hide();                        
                          $('#btnLog').click();
                          $("#txtFolder").parent().addClass('error');
                          $("#txtFolder").focus();
                          $("label[for='txtFolder']").html(data.msg);
                        }
                        else
                        {
                          var message   = data.msg;
                          $("#message").html(message);
                          $("#loading").hide();                        
                          $('#btnLog').click();
                          $("#txtId").parent().addClass('error');
                          $("#txtId").focus();
                          $("label[for='txtId']").html(data.msg);
                        }                   
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                          $('#btnLog').click();      
                          setTimeout(function () {
                            $("#message").html('Đường truyền gặp sự cố, thao tác không thể thực hiện được.');
                            $("#loading").hide();
                            $('#btnclose').click(function(){
                              $('.close').click();
                            }); 
                          }, 1000);
                      }
                    });
                  }
                    return false;

                });


                  
              });
    </script>