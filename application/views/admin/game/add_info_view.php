  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li class="active">Tạo project</li>
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
                <h2>Thêm mới project</h2>
                <?php echo form_open('', array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Tên project:</label>
                    <input type="text" id="txtName" name="txtName" placeholder="Tên project" maxLength="255">
                  </div>
                  <div class="row-fluid">                 
                    <label>Tên không dấu:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Tên không dấu" maxLength="255">
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Trạng thái:</label>   
                    <input type="radio" id="rdstatus" name="rdstatus" value="1" style="margin-left: 20px;margin: 5px;" checked>Hoạt động  
                    <input type="radio" id="rdstatus1" name="rdstatus" value="0" style="margin-left: 20px;margin: 5px;">Tạm ngưng                
                  </div>
                  <div class="row-fluid" style="margin-bottom: 10px;">                 
                    <label>Kích hoạt admod:</label>   
                    <input type="radio" id="rdstatus" name="rdstatus" value="1" style="margin-left: 20px; margin: 5px;" checked>Kích hoạt   
                    <input type="radio" id="rdstatus1" name="rdstatus" value="0" style="margin-left: 20px; margin: 5px;">Chưa kích hoạt                
                  </div>                  
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Thêm</button> <button type="reset" class="btn btn-large"> Hủy</button>
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
                  $('#txtName').keypress(function(){
                        
                      var alias = changetitle($('#txtName').val());
                      $('#txtAlias').val(alias);                      
                  });    
                    
                    
                  $("form#frm").on('submit', function(){
        
                  var from = $(this);

                    $.ajax({
                      url: from.attr('action'),
                      type: from.attr('method'),
                      data: $(from).serialize(),
                      beforeSend : function (){
                        $("#loading").show();
                      },
                      success: function(data) { 
                          $("#loading").hide();                        
                          $('#btnLog').click();       
                          $('#btnclose').click(function() {  
                            $("#loading").show();                                                        
                            setTimeout(function () {                             
                              window.location.href = "";       
                            }, 2000);
                          });     
                          $('.modal-backdrop').click(function() {                               
                              window.location.href = "";  
                          });                
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                          $('#btnLog').click();      
                          setTimeout(function () {
                            $("#message").html('Đường truyền gặp sự cố, thao tác không thể thực hiện được.');
                            $("#loading").hide();
                            $('#btnclose').click(function(){
                              $('.close').click();
                            }); 
                          }, 2000);
                      }
                    });

                    return false;

                });


                  
              });
    </script>