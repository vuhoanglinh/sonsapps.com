<link href="<?php echo base_url(); ?>themes/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>themes/js/moment.js"></script>  
  <script src="<?php echo base_url(); ?>themes/js/bootstrap-datetimepicker.min.js"></script>  
<script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>

<?php 
    foreach($faq as $row) {
?>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/events.html'); ?>">Faq</a> <span class="divider">/</span></li>
            <li class="active">Chỉnh sửa câu hỏi</li>
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
                <h2>Thêm mới câu hỏi</h2>
                <?php echo form_open(base_url('admin/action_faq/edit'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Câu hỏi <span style="color:red">*</span>:</label>
                    <input type="text" id="txtQuestion" name="txtQuestion" placeholder="Câu hỏi" value="<?php echo $row->question; ?>" maxLength="255">
                    <label for="txtQuestion"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Alias <span style="color:red">*</span>:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Alias" value="<?php echo $row->alias; ?>" maxLength="255">
                    <label for="txtAlias"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Project:</label>
                    <select id="slType" name="slType" style="padding: 5px;">
                      <option value="0" <?php echo ($row->type == 0) ? 'checked' : 0; ?></optio>Kimi là gì?</option> 
                      <option value="1" <?php echo ($row->type == 1) ? 'checked' : 0; ?>>Cách thức hoạt động</option> 
                      <option value="2" <?php echo ($row->type == 2) ? 'checked' : 0; ?>>Mô hình kiếm tiền</option> 
                      <option value="3" <?php echo ($row->type == 3) ? 'checked' : 0; ?>>Các câu hỏi khác</option>
                    </select>                         
                  </div>
                  <div class="row-fluid">                 
                    <label>Số thứ tự:</label>
                    <input type="text" id="txtNumber" name="txtNumber" style="width: 20%;" placeholder="Số thứ tự" value="<?php echo $row->index; ?>" maxLength="255">
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Trạng thái:</label>   
                    <input type="radio" id="rdstatus" name="rdstatus" value="1" style="margin-left: 20px;margin: 5px;" checked>Hiện   
                    <input type="radio" id="rdstatus1" name="rdstatus" <?php echo ($row->status == 0) ? 'checked' : 0; ?> value="0" style="margin-left: 20px;margin: 5px;">Ẩn                
                  </div>
                  <div class="row-fluid">                 
                    <label>Ngôn ngữ:</label>
                     <select id="slLang" name="slLang" style="padding: 5px;">
                      <option value="vietnamese" <?php echo ($row->lang == 'vietnamese') ? 'selected' : ''; ?>>Tiếng việt</option>
                      <option value="english" <?php echo ($row->lang == 'english') ? 'selected' : ''; ?>>English</option>
                      <option value="indonesia" <?php echo ($row->lang == 'indonesia') ? 'selected' : ''; ?>>Indenesia</option>
                      <option value="portugal" <?php echo ($row->lang == 'portugal') ? 'selected' : ''; ?>>Portugal</option>
                      <option value="china" <?php echo ($row->lang == 'china') ? 'selected' : ''; ?>>China</option>
                    </select>                         
                  </div>
                  <div class="row-fluid">                 
                    <label>Nội dung trả lời:</label>
                     <textarea id="txtAnwser" name="txtAnwser" placeholder="Tên không dấu"></textarea>
                  </div>                
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Cập nhật</button> <button type="reset" class="btn btn-large" style="margin-right: 10px;"> Hủy</button>
                  <a href="<?php echo base_url('admin/faq/lists.html'); ?>" class="btn btn-large">Quay lại</a>
                  <span id="loading1"  style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></span>
                  <input type="hidden" name="oldquestion" value="<?php echo $row->question;  ?>" />
                  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
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

<?php 
} //Endforeach
?>
    <script>
      $('#myModal').modal('hidden');
    </script>

   <script type="text/javascript">
              
                $(document).ready(function() {   
                  CKEDITOR.replace('txtAnwser');
                  $('#txtQuestion').on('blur keypress',function(){
                        
                      var alias = changetitle($('#txtQuestion').val());
                      $('#txtAlias').val(alias);                      
                  });    
                  $('#btnclose').click(function() {  
                    $("#loading").show();                                                        
                    setTimeout(function () {                             
                      $('.modal-backdrop').click();
                    }, 500);
                  });     
                  $('#btnLog').click(function() {  
                  });
                    
                  $("form#frm").on('submit', function(){
                    CKEDITOR.instances['txtAnwser'].updateElement(); //Updates CKeditor before get value by ajax
                    var from = $(this);
                    if($("#txtQuestion").val() == "")
                      {
                        var $msg    =   "<?php echo $this->lang->line('message_null'); ?>";
                        $("#txtQuestion").focus();
                        $("#txtQuestion").parent().addClass('error');
                        $("label[for='txtQuestion']").html($msg);
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
                              $("#loading1").hide();                                
                              $('p#message').html(data.msg);
                              $('#btnLog').click();  
                              
                              if(data.status == '2')
                              {
                                  $('#oldquestion').val($('#txtQuestion').val());
                              }
                              else if(data.status == '1'){
                                    var $msg    =   data.msg;
                                    $("#txtQuestion").focus();
                                    $("#txtQuestion").parent().addClass('error');
                                    $("label[for='txtQuestion']").html($msg);                                  
                                    //$('#btnclose').click();
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