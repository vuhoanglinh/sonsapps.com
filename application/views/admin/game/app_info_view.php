<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li class="active">Project</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <script src="<?php echo base_url('themes/js').'/extention.js'; ?>" type="text/javascript"></script>
    <div class="container min-height">
      <div class="row-fluid">
      		<div class="span12">
      			<h2>Thêm mới project</h2>
                <?php echo form_open(base_url('admin/addproject'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">                 
                    <label>Tên project <span style="color:red">*</span>:</label>
                    <input type="text" id="txtName" name="txtName" placeholder="Tên project" maxLength="255">
                    <label for="txtName"></label>
                  </div>
                  <div class="row-fluid">                 
                    <label>Tên không dấu <span style="color:red">*</span>:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Tên không dấu" maxLength="255">
                      <label for="txtAlias"></label>
                  </div>
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Thêm project</button>
                <?php echo form_close(); ?>
                <script type="text/javascript">
                  $(document).ready(function(){
                    $('#btnclose').click(function() {  
                      $("#loading").show();                                                        
                      setTimeout(function () {                             
                        $('.modal-backdrop').click();
                      }, 500);
                    });     
                    $('.modal-backdrop').click(function() {  
                    });
                      
                     $('#txtName').on(' blur keypress',function(){
                        
                          var alias = changetitle($('#txtName').val());
                          $('#txtAlias').val(alias);                      
                      });   
                      
                    $('form#frm').on('submit', function(){
                      var form = $(this);
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
                          data: $(from).serialize(),
                          dataType: 'json',
                          beforeSend : function (){
                            $("#loading").show();
                          },
                          success: function(data) {     
                            if(data.status == '1')  
                            {                          
                              window.location.reload();  
                            }    
                            else
                            {
                              $('#btnLog').click();
                              $("#message").html(data.msg);
                              $("#loading").hide();
                              $("#txtName").parent().addClass('error');
                              $("#txtName").focus();
                              $("label[for='txtName']").html(data.msg);
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
                              }, 500);
                          }
                        });
                    }
                    return false;
                        
                    });



                    
                  });
                </script>
      		</div>
            <div class="span12" style="margin-left: 0">
            	<h2>Quản lý Project <span class="pull-right"><?php echo $total; ?> project</span></h2>  
            	<table class="table table-striped table-hover">
            		<thead>
            			<tr>
	            			<th>Tên project</th>
	            			<th>Trạng thái</th>
	            			<th>Kích hoạt admod</th>
	            			<th>TotalVip</th>
	            			<th>TotalNomal</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
	            			<th>#</th>
            			</tr>
            		</thead>
            		<tbody>
                  <?php foreach ($arr_project as $row) {
                    # code...
                  ?>
            			<tr>
	            			<td><?php echo $row->Name; ?></td>
	            			<td><span action="locked" fullname="<?php echo $row->Name; ?>" style="cursor: pointer;" class="label <?php echo ($row->locked == 1) ? 'label-success' : 'label-warning';?>" data="<?php echo ($row->locked == 1) ? 0 : 1; ?>" dataid="<?php echo $row->projectId; ?>"><?php echo ($row->locked == 1) ? 'Hoạt động' : 'Tạm ngưng';?></span></td>
	            			<td><span action="activeAdmob" fullname="<?php echo $row->Name; ?>" style="cursor: pointer;" class="label <?php echo ($row->activeAdmob == 1) ? 'label-success' : 'label-warning';?>" data="<?php echo ($row->activeAdmob == 1) ? 0: 1; ?>" dataid="<?php echo $row->projectId; ?>"><?php echo ($row->activeAdmob == 1) ? 'Đang kích hoạt' : 'Chưa kích hoạt';?></span></td>
	            			<td><?php echo $row->totalVip; ?></td>
	            			<td><?php echo $row->totalNormal; ?></td>
                    <td><?php echo mdate($datestring, strtotime($row->created_at)); ?></td>
                    <td><?php echo mdate($datestring, strtotime($row->updated_at)); ?></td>
	            			<td style="width:200px;">
                      <a href="<?php echo base_url('admin/application/edit_project/'.$row->projectId); ?>" class="btn">Chỉnh sửa</a> 
                      <a action="del" href="javascript:void(0)" data="<?php echo $row->projectId; ?>" fullname="<?php echo $row->Name; ?>" class="btn">Xóa</a></td>
            			</tr>
                <?php } //endforeach ?>            			
            		</tbody>
            	</table>
            </div>
            <div class="span12 text-center">
            <?php     

             echo $pagging; // tạo link phân trang 

            ?>
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

            <a href="#myMsg" id="showMsg" role="button" data-toggle="modal" style="display: none;"></a>

            <div id="myMsg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-header">        
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel1"><i class="icon-mail"></i>THÔNG BÁO</h3>
              </div>
              <div class="modal-body">
                <p id="msg"></p>
                <p id="loading" style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></p>
                <button type="button" id="btnMsg" class="btn"><i class="icon-paper-plane"></i> Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Hủy bỏ</button>        
              </div>
            </div>
            <script>
              $('#myModal').modal('hidden');
              $('#myMsg').modal('hidden');
            </script>
            <script type="text/javascript">
              $(document).ready(function(){
                  var $status  =   "";
                  var $id      =   "";
                  var $object  =   "";
                  var $type    =   "";
                $('body').on('click', "span[action='locked']", function(){

                  $object   =   $(this);
                  $type     =   0;  
                  $status   =   $object.attr('data'); 
                  $id       =   $object.attr('dataid');  
                  $('#msg').html('Bạn có muốn thay đổi trạng thái của project ' + $object.attr('fullname') + ' không?');
                  $('#showMsg').click(); 

                });


                $('body').on('click', "span[action='activeAdmob']", function(){

                  $object   =   $(this);
                  $type     =   1;  
                  $status   =   $object.attr('data'); 
                  $id       =   $object.attr('dataid'); 
                  $('#msg').html('Bạn có muốn thay đổi trạng thái admod của project ' + $object.attr('fullname') + ' không?');
                  $('#showMsg').click(); 

                });

                $('body').on('click', "a[action='del']", function(){
                  var a   = $(this);
                  $id     = a.attr('data');
                  $object = a;
                  $type   = 2;
                  $('#msg').html('Bạn có chắc chắn là xóa project ' + a.attr('fullname') + ' không?');
                  $('#showMsg').click(); 
                });

                $('#btnMsg').on('click', function() {
                    $('#loading').show();
                    switch($type)
                    {
                      case 0:
                            $.ajax({
                              url : "<?php echo base_url('admin/action_project/updateLocked') ?>",
                              type : "POST",
                              dataType : "json",
                              data: {status : $status, id : $id},
                              success : function(data){
                                if(data.info == 1)
                                {
                                  if(data.status == 0)
                                  {
                                    $object.removeClass('label-success');
                                    $object.addClass('label-warning');
                                    $object.html('Tạm ngưng');
                                    $object.attr('data','1');  
                                  }
                                  else
                                  {
                                    $object.addClass('label-success');
                                    $object.removeClass('label-warning');                     
                                    $object.html('Hoạt động');
                                    $object.attr('data','0'); 
                                  }
                                }

                                $('#msg').html('Thông tin đã cập nhật thành công');
                                      setTimeout(function () { 
                                        $('.close').click();
                                      }, 500);
                              }
                            });

                            break;
                      case 1:
                            $.ajax({
                              url : "<?php echo base_url('admin/action_project/updateAdMod') ?>",
                              type : "POST",
                              dataType : "json",
                              data: {status : $status, id : $id},
                              success : function(data){
                                if(data.info == 1)
                                {
                                  if(data.status == 0)
                                  {                              
                                    $object.removeClass('label-success');
                                    $object.addClass('label-warning');
                                    $object.html('Chưa kích hoạt');
                                    $object.attr('data','1');  
                                  }
                                  else
                                  {
                                    $object.addClass('label-success');
                                    $object.removeClass('label-warning');                     
                                    $object.html('Đang kích hoạt');
                                    $object.attr('data','0'); 
                                  }
                                }

                                $('#msg').html('Thông tin đã cập nhật thành công');
                                setTimeout(function () { 
                                  $('.close').click();
                                }, 500);
                              }
                            });
                            break;
                      case 2:
                            $.ajax({
                              url : "<?php echo base_url('admin/action_project/deleteProject') ?>",
                              type : "POST",
                              data: {id : $id},
                              success : function(data){
                                $('#loading').hide();                               

                                if(data == '1')
                                {
                                  $('#msg').html('Đã xóa tài khoản thành công');
                                  setTimeout(function () { 
                                    window.location.reload();
                                  }, 500);
                                }
                                else
                                {
                                  $('#msg').html('Thao tác xảy ra lỗi, vui lòng thử lại.');
                                  setTimeout(function () { 
                                    $('.close').click();
                                  }, 1000);
                                }
                                
                              }
                            });
                            break;                    
                    }               
                });

              });
            </script>
      </div>
    </div>