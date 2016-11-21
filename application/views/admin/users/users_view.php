<script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li class="active">Thành viên</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height">
      <div class="row-fluid">
            <div class="span12">
            	<h2>Quản lý thành viên <span class="pull-right"><?php echo $count_user; ?> tài khoản</span></h2>
            	<div class="span6 pull-left" style="margin-left: 0;">
                <form action="" method="post">
                  <div class="row-fluid">     
                    <input type="text" id="txtSearch" name="txtSearch" style="width: 40%;padding: 7px;" placeholder="Từ khóa tìm kiếm" maxLength="255">
                    <button type="button" id="btnSearch" class="btn btn-large" style="margin-bottom: 10px;">Tìm kiếm</button>  
                  </div>
                </form>
              </div>

              <script type="text/javascript">
                $(document).ready(function() {
                  $('#btnSearch').on('click', function(){
                    if($('#txtSearch').val() != "") {
                      window.location.href   = "<?php echo base_url('admin/users').'/?key=' ?>" + $('#txtSearch').val();
                    }
                    else
                    {
                      window.location.href   = "<?php echo base_url('admin/users'); ?>";
                    }
                  });
                });
              </script>
              <div class="span6 pull-right">
                <p class="pull-right">         
                  <?php 
                    if($key != NULL)
                    {
                  ?>
                    <a target="_blank" href="<?php echo base_url('admin/user/export/excel'); ?><?php echo ($key != '') ? '?key='.$key : ''; ?>" class="btn btn-large">Export Excel</a> 
                    <a target="_blank" href="<?php echo base_url('admin/user/export/csv'); ?><?php echo ($key != '') ? '?key='.$key : ''; ?>" class="btn btn-large">Export CSV</a> 
                  <?php    
                    }
                    else
                    {
                  ?>           
                    <a target="_blank" href="<?php echo base_url('admin/user/export/excel'); ?><?php echo ($app != '') ? '?app='.$app : ''; ?>" class="btn btn-large">Export Excel</a> 
                    <a target="_blank" href="<?php echo base_url('admin/user/export/csv'); ?><?php echo ($app != '') ? '?app='.$app : ''; ?>" class="btn btn-large">Export CSV</a> 
                  <?php } ?>
                    <a href="<?php echo base_url('admin'); ?>" class="btn btn-large">Quay lại</a></p>
            	</div>

              <?php 
                if($key != NULL)
                {
                  if(count($user) > 0)
                  {
              ?>
              <div class="span12">
                <h4>Kết quả với từ khóa tìm kiếm: "<?php echo $key; ?>"</h4>
              </div>
              <?php 
                  }
                  else
                  {
              ?>
              <div class="span12">
                <h4>Không tìm thấy kết quả với từ khóa tìm kiếm: "<?php echo $key; ?>"</h4>
              </div>
              <?php

                  }
              } ?>
              <div class="span12" style="margin-left: 0;">
                <form action="" method="post" class="pull-right">   
                    <label>Lọc thành viên theo trạng thái:</label>               
                    <select id="slType" style="padding: 6px;">   
                      <option value="4" <?php echo ($type == 4)? 'selected' : '';?>>Thành viên</option>
                      <option value="5" <?php echo ($type == 5)? 'selected' : '';?>>Admin</option>
                      <option value="0" <?php echo ($type == 0)? 'selected' : '';?>>Chưa kích hoạt</option>
                      <option value="1" <?php echo ($type == 1)? 'selected' : '';?>>Đã kích hoạt</option>  
                      <option value="2" <?php echo ($type == 2)? 'selected' : '';?>>Chưa khóa</option> 
                      <option value="3" <?php echo ($type == 3)? 'selected' : '';?>>Đã khóa</option>  
                      <option value="">Hiện tất cả</option>                  
                    </select> 
                    <button type="button" id="filter" class="btn" style="margin-bottom:10px;">Lọc</button>                    
                </form>
                <form action="" method="post" class="pull-right" style="margin-right: 20px;"> 
                    <label>Lọc thành viên theo ứng dụng:</label> 
                    <label style="display: inline; margin-right: 10px;">Project:</label> 
                    <select style="display: inline; margin-right: 10px; padding: 6px;" id="slfilterProject" name="slfilterProject">
                      <?php foreach ($arr_app as $row) {
                        # code...
                      ?>
                      <option value="<?php echo $row->projectId; ?>"><?php echo $row->Name; ?></option>
                      <?php } ?>
                    </select>
                    <label style="display: inline; margin-right: 10px;">Ứng dụng:</label>
                    <select style="display: inline; margin-right: 10px; padding: 6px;" id="slfilterApp" name="slfilterApp">
                     
                    </select>  
                    <button type="button" id="filterApp" class="btn" style="margin-bottom:10px;">Lọc</button>
                </form>
              </div>
              <script type="text/javascript">
                $(document).ready(function() { 
                  function loadapp(projectid, object)
                  {
                    $.ajax({
                      url: '<?php echo base_url("admin/user/getSelectApp") ?>',
                      type: 'get',
                      data: {projectId : projectid},
                      success: function(data){
                        object.html(data);
                      }
                    });
                  }

                  loadapp($('#slfilterProject').val(), $('#slfilterApp'));
                  loadapp($('#slProject').val(), $('#slApp'));
                  $('#slfilterProject').on('change', function(){
                    loadapp($('#slfilterProject').val(), $('#slfilterApp'));
                  });

                  $('#slProject').on('change', function(){
                    loadapp($('#slProject').val(), $('#slApp'));
                  });

                  $('#filter').on('click', function(){          

                    if($('#slType').val() == "")
                    {
                       window.location.href   = "<?php echo base_url('admin/users'); ?>";
                    }
                    else
                    {
                      <?php 
                        if($key != NULL)
                        {
                      ?>
                          window.location.href   = "<?php echo base_url('admin/users').'/?key='.$key; ?>&active=" + $('#slType').val();
                      <?php
                        }
                        else
                        {
                      ?>
                          window.location.href   = "<?php echo base_url('admin/users'); ?>/?active=" + $('#slType').val();
                      <?php
                        }
                      ?>     
                    }                                   
                  });

                  $('#filterApp').on('click', function(){  
                    if($('#slfilterApp').val() != null) 
                      window.location.href   = "<?php echo base_url('admin/users');?>/?app=" + $('#slfilterApp').val();
                  });

                });
              </script>
              <table class="table table-striped table-hover">
            		<thead>
            			<tr>
                    <th>ID</th>
            				<th>Họ tên</th>
	            			<th>Tên tài khoản</th>
	            			<th>Số điện thoại</th>
	            			<th>Email</th>
	            			<th>Cấp độ</th>
                    <th>Active</th>
                    <th>Block</th>
	            			<th>#</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php
            				foreach($user as $row)
            				{
            			?>
            			<tr <?php echo ($row->block == 1)?'style="background-color:#CCC;"': ''; ?>>
                    <td><?php echo $row->id; ?></td>
            				<td><?php echo $row->fullname; ?></td>
            				<td><?php echo $row->username; ?></td>
            				<td><?php echo $row->phone; ?></td>
            				<td><?php echo $row->email; ?></td>
            				<td><span action="level" style="cursor: pointer;" class="label <?php echo ($row->level == 1) ? 'label-danger' : 'label-info';?>" data="<?php echo ($row->level == 1) ? 0: 1; ?>" dataid="<?php echo $row->id; ?>" fullname="<?php echo $row->fullname; ?>"><?php echo ($row->level == 1) ? 'Admin' : 'Thành viên'; ?></span></td>
                    <td><span action="active" style="cursor: pointer;" class="label <?php echo ($row->active == 1) ? 'label-success' : 'label-warning';?>" data="<?php echo ($row->active == 1) ? 0: 1; ?>" dataid="<?php echo $row->id; ?>" fullname="<?php echo $row->fullname; ?>"><?php echo ($row->active == 1) ? 'Đã kích hoạt' : 'Chưa kích hoạt';?></span></td>
                    <td><span action="block" style="cursor: pointer;" class="label <?php echo ($row->block == 1) ? '' : 'label-info';?>" data="<?php echo ($row->block == 1) ? 0: 1; ?>" dataid="<?php echo $row->id; ?>" fullname="<?php echo $row->fullname; ?>"><?php echo ($row->block == 1) ? 'Đã khóa' : 'Khóa';?></span></td>
	             			<td style="width: 200px;"><a href="#myModal" action="up" user="<?php echo $row->fullname; ?>" username="<?php echo $row->id; ?>" role="button" data-toggle="modal" class="btn">Up game</a> 
                      <a action="del" href="javascript:void(0)" data="<?php echo $row->id; ?>" fullname="<?php echo $row->fullname; ?>" class="btn">Xóa tài khoản</a></td>
            			</tr>
            			<?php
            				}
            			?>
            		</tbody>
            	</table>
            </div>
            <div class="span12 text-center" style="margin-left: 0;">
            <?php     

             echo $pagging; // tạo link phân trang 

            ?>
            </div>
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
<!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">ĐĂNG APP CHO THÀNH VIÊN : <span id="user"></span></h3>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/user/upapp'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div class="row-fluid">  
                    <label>Project:</label> 
                    <select style="padding: 5px;width: 83%;" id="slProject" name="slProject">
                      <?php foreach ($arr_app as $row) {
                      ?>
                      <option value="<?php echo $row->projectId; ?>"><?php echo $row->Name; ?></option>
                      <?php } ?>
                    </select>          
                  </div>

                  <div class="row-fluid">
                    <label>Ứng dụng:</label>
                    <select id="slApp" name="slApp" style="padding: 5px;width: 83%;">
                     
                    </select> 
                  </div>

                  <div class="row-fluid">                 
                    <label>Đường dẫn:</label>
                    <input type="text" id="txtLink" name="txtLink" style="width: 67%;" placeholder="Đường dẫn source app" maxLength="255">
                    <div class="fileUpload btn" style="margin-bottom: 10px;"
                      <span><img src="<?php echo base_url(); ?>/themes/img/Arrow-upload-2-icon.png"></span>
                      <br>
                      <input type="file" id="fileImage" name="fileImage" class="upload"/>
                    </div>                    
                    
                  </div>

                  <div class="row-fluid">                 
                    <label>Key mod:</label>
                    <input type="text" id="txtKeyMod" name="txtKeyMod" placeholder="Key mod" maxLength="250">
                  </div>

                  <div class="row-fluid">                 
                    <label>Admob User:</label>
                    <input type="text" id="txtAbmodUser" name="txtAbmodUser" placeholder="Admob User" maxLength="250">  
                  </div>
                  <div class="row-fluid">                 
                    <label>Admob Admin:</label>
                    <input type="text" id="txtAbmodAdmin" name="txtAbmodAdmin" placeholder="Admob Admin" maxLength="250">                    
                    
                  </div>
                  <div class="row-fluid">                 
                    <label>SMS Number:</label>
                    <input type="text" id="txtSmsNumber" name="txtSmsNumber" placeholder="SMS Number" maxLength="100">  
                  </div>
                  <div class="row-fluid">                 
                    <label>SMS Content:</label>
                    <input type="text" id="txtSmsContent" name="txtSmsContent" placeholder="SMS Content" maxLength="200">
                  </div>

                  <br />
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> <i class="icon-paper-plane"></i> Cập nhật</button>
                  <button type="button" style="margin-right: 10px;" class="btn btn-large" data-dismiss="modal" aria-hidden="true"><i class="icon-cancel"></i> Hủy</button>
                  <img id="loading" style="display:none;" src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" />
                  <input type="hidden" id="username" name="username" value="0">
                  <label id="appmsg" style="color: red;"></label>

        <?php echo form_close(); ?>
      </div>
    </div>
    <script>
      $('#myModal').modal('hidden');
      $('#myMsg').modal('hidden');
    </script>
        
        <script type="text/javascript">
                $(document).ready(function() {  
                  
                  $('#fileImage').on('change', function(){
                    $('#txtLink').val($(this)[0].files[0].name);
                    if($('#fileImage').val() == "")
                    {
                      $('#txtLink').val('');
                    }
                  });
                  
                  $('#txtLink').click(function()
                  {
                    $('#fileImage').click();
                  });
                  $('#fileImage').on('blur', function(){
                    if($('#fileImage').val() == "")
                    {
                      $('#txtLink').val('');
                    }
                  });
                  
                  $('a[action="up"]').on('click', function() {
                      var a =  $(this);
                      $('#user').html(a.attr('user'));
                      $('#username').val(a.attr('username')); 
                      $('#frm')[0].reset();
                  });
                  
                  /*
                  function SetFileField(fileUrl) {
                    jQuery('#txtLink').val(fileUrl);
                  } 
                  $("#btnImage").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
                  }); 
                  */
                  $("form#frm").on('submit', function(){    
                    var from    =   $(this);
                    if($('#slApp').val() == null) 
                    {
                      $('#appmsg').html('Không có ứng dụng nào được chọn');
                      $('#appmsg').focus();
                    }
                    else if($('#txtLink').val() == "")
                    {
                      $('#appmsg').html('Chưa có đường dẫn source app');
                      $('#appmsg').focus();
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
                          $("#loading").hide();    
                          $('#appmsg').html(data.msg); 
                          setTimeout(function () {
                            window.location.reload();
                          }, 500);
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
                  

                  var $status  =   "";
                  var $id      =   "";
                  var $object  =   "";
                  var $type    =   "";

                $('body').on('click', "span[action='level']", function(){

                  var a   = $(this);
                  $status = a.attr('data');
                  $id     = a.attr('dataid');
                  $object = a;
                  $type   = 1;
                  $('#msg').html('Bạn có muốn thay đổi cấp độ của thành viên ' + a.attr('fullname'));
                  $('#showMsg').click();                  
                });

                $('body').on('click', "span[action='active']", function(){
                  var a   = $(this);
                  $status = a.attr('data');
                  $id     = a.attr('dataid');
                  $object = a;
                  $type   = 0;
                  $('#msg').html('Bạn có muốn thay đổi trạng thái kích hoạt tài khoản của ' + a.attr('fullname') + ' không?');
                  $('#showMsg').click(); 
                });

                $('body').on('click', "span[action='block']", function(){

                  var a   = $(this);
                  $status = a.attr('data');
                  $id     = a.attr('dataid');
                  $object = a;
                  $type   = 2;
                  $('#msg').html('Bạn có muốn thay đổi trạng thái khóa thành viên ' + a.attr('fullname') + ' không?');
                  $('#showMsg').click();                  
                });

                $('body').on('click', "a[action='del']", function(){
                  var a   = $(this);
                  $id     = a.attr('data');
                  $object = a;
                  $type   = 3;
                  $('#msg').html('Bạn có chắc chắn là xóa tài khoản của ' + a.attr('fullname') + ' không?');
                  $('#showMsg').click(); 
                });

                $('#btnMsg').on('click', function() {
                    $('#loading').show();
                    switch($type)
                    {
                      case 0:
                            $.ajax({
                              url : "<?php echo base_url('admin/user/updateActive') ?>",
                              type : "POST",
                              dataType : "json",
                              data: {status : $status, id : $id},
                              success : function(data){
                                $('#loading').hide();
                                if(data.info == '1')
                                {
                                  if(data.status == '0')
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
                                    $object.html('Đã kích hoạt');
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
                              url : "<?php echo base_url('admin/user/updateLevel') ?>",
                              type : "POST",
                              dataType : "json",
                              data: {status : $status, id : $id},
                              success : function(data){
                                $('#loading').hide();
                                if(data.info == '1')
                                {
                                  if(data.status == '0')
                                  {      
                                    $object.addClass('label-info');
                                    $object.removeClass('label-danger');   
                                    $object.html('Thành viên');
                                    $object.attr('data','1');  
                                  }
                                  else
                                  {   
                                    $object.removeClass('label-info');
                                    $object.addClass('label-danger');                 
                                    $object.html('Admin');
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
                              url : "<?php echo base_url('admin/user/updateBlock') ?>",
                              type : "POST",
                              dataType : "json",
                              data: {status : $status, id : $id},
                              success : function(data){
                                $('#loading').hide();
                                if(data.info == '1')
                                {
                                  if(data.status == '0')
                                  {   
                                    $object.addClass('label-info');               
                                    $object.html('Khóa');
                                    $object.attr('data','1'); 
                                    $object.parent().parent().removeAttr('style');  
                                  }
                                  else
                                  {                                      
                                    $object.removeClass('label-info');
                                    $object.html('Đã khóa');
                                    $object.attr('data','0');
                                    $object.parent().parent().attr('style', 'background-color: #CCC');
                                  }
                                }

                                $('#msg').html('Thông tin đã cập nhật thành công');
                                setTimeout(function () { 
                                  $('.close').click();
                                }, 500);
                              }
                            });
                            break;
                    case 3:
                            $.ajax({
                              url : "<?php echo base_url('admin/user/deleteUser') ?>",
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
