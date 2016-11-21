  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/faq.html'); ?>">Faq</a> <span class="divider">/</span></li>
            <li class="active">Thêm câu hỏi</li>
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
                <?php echo form_open(base_url('admin/action_faq/add'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Câu hỏi <span style="color:red">*</span>:</label>
                    <input type="text" id="txtQuestion" name="txtQuestion" placeholder="Câu hỏi" maxLength="255">
                    <label for="txtQuestion"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Alias <span style="color:red">*</span>:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Alias" maxLength="255">
                    <label for="txtAlias"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Project:</label>
                    <select id="slType" name="slType" style="padding: 5px;">
                      <option value="0">Kimi là gì?</option> 
                      <option value="1">Cách thức hoạt động</option> 
                      <option value="2">Mô hình kiếm tiền</option> 
                      <option value="3">Các câu hỏi khác</option>
                    </select>                         
                  </div>
                  <div class="row-fluid">                 
                    <label>Số thứ tự:</label>
                    <input type="text" id="txtNumber" name="txtNumber" style="width: 20%;" placeholder="Số thứ tự" value="0" maxLength="255">
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
                 <div class="row-fluid">                 
                    <label>Nội dung trả lời:</label>
                     <textarea id="txtAnwser" name="txtAnwser" placeholder="Tên không dấu"></textarea>
                  </div>                
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Thêm</button> <button type="reset" class="btn btn-large" style="margin-right: 10px;"> Hủy</button>
                  <a href="<?php echo base_url('admin/faq.html'); ?>" class="btn btn-large">Quay lại</a>
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
        <a href="javascript:void(0)" id="btnclose" class="btn btn-large">Đóng </a>
      </div>
    </div>
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
                                    $("#txtQuestion").focus();
                                    $("#txtQuestion").parent().addClass('error');
                                    $("label[for='txtQuestion']").html($msg);
                                  
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