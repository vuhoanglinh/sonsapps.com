<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li class="active">Đang hoạt động</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height2">
      <div class="row-fluid">
		<div class="row">
            <div class="span12">
            	<h2>Quản lý game đang hoạt động</h2>
              <p class="pull-right">
                <a href="<?php echo base_url('admin/application/start'); ?>" class="btn btn-large">Hiện tất cả</a>
                <a href="<?php echo base_url('admin/application'); ?>" class="btn btn-large">Quay lại</a>
              </p>
            	<div class="span12" style="margin-left: 0;">
                <form action="" method="post" class="pull-right" style="margin-right: 20px;">   
                      <label>Lọc theo ngôn ngữ:</label>               
                      <select id="slLang" style="padding: 6px;">   
                        <option value="vietnamese" <?php echo ($lang == 'vietnamese')? 'selected' : '';?>>Tiếng Việt</option>
                        <option value="english" <?php echo ($lang == "english")? 'selected' : '';?>>English</option>                      
                        <option value="indonesia" <?php echo ($lang == "indonesia")? 'selected' : '';?>>Indonesia</option>                      
                        <option value="portugal" <?php echo ($lang == "portugal")? 'selected' : '';?>>Portugal</option>                      
                        <option value="china" <?php echo ($lang == "china")? 'selected' : '';?>>China</option>                      
                      </select> 
                      <button type="button" id="filter" class="btn" style="margin-bottom:10px;">Lọc</button>                    
                  </form>
              </div>
              <script type="text/javascript">
                $(document).ready(function() {                  
                  $('#filter').on('click', function(){          

                     window.location.href   = "<?php echo base_url('admin/application/start'); ?>?lang=" + $('#slLang').val();
                             
                  });                         
                });
              </script>
                <table class="table table-striped table-hover">
              		<thead>
              			<tr>
                      <th>AppID</th>
                      <th>Tên Project</th>
  	            			<th>Package name</th>
  	            			<th>Hình ảnh</th>
  	            			<th>Ngôn ngữ</th>
  	            			<th>Ngày tạo</th>
  	            			<th>Ngày cập nhật</th>
  	            			<th>#</th>
              			</tr>
              		</thead>
              		<tbody>
                          <?php
                                foreach($app as $row) {
                          ?>
              			<tr>
              				<td><?php echo $row->id; ?></td>
                      <td><?php echo $row->projectName; ?></td>
                      <td><?php echo $row->packageName; ?></td>
              				<td><img width="60" src="<?php echo ($row->logo != "") ? $row->logo : base_url(IMAGE_DUMMY_SMALL); ?>" /></td>
              				<td style="text-align:center"><?php 
                                    switch($row->language)
                                    {
                                        case 'vietnamese' : echo '<img src="'.base_url('themes/img/flag/1.png').'" />';break;
                                        case 'english' : echo '<img src="'.base_url('themes/img/flag/2.png').'" />';break;
                                        case 'indonesia' : echo '<img src="'.base_url('themes/img/flag/3.png').'" />';break;
                                        case 'portugal' : echo '<img src="'.base_url('themes/img/flag/4.png').'" />';break;
                                        case 'china' : echo '<img src="'.base_url('themes/img/flag/5.png').'" />';break;
                                    }
                                    ?></td>                            
              				<td><?php echo mdate($datestring, strtotime($row->created_at)); ?></td>
              				<td><?php echo mdate($datestring, strtotime($row->updated_at)); ?></td>
              				<td style="width:300px;">
                        <a href="<?php echo base_url('admin/application/images/'.$row->id); ?>" class="btn">Ảnh</a> 
                        <a href="<?php echo base_url('admin/users?app='.$row->id); ?>" class="btn">Thành viên</a> 
                        <a href="<?php echo base_url('admin/application/edit/'.$row->id); ?>" class="btn">Chỉnh sửa</a> 
                        <a action="del" href="javascript:void(0)" data="<?php echo $row->id;?>" fullname="<?php echo $row->projectName; ?>" class="btn">Xóa</a></td>
              			</tr>
                          <?php } //Endforeach?>
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
      $('#myMsg').modal('hidden');
    </script>
    <script type="text/javascript">
        $(document).ready(function() {  
            var $id     =   "";
            $('body').on('click', "a[action='del']", function(){
                $id     =   $(this).attr('data');
                $('#msg').html('Bạn có chắc chắn là xóa ứng dụng này không?');
                $('#showMsg').click(); 
                
            });
            $('#btnMsg').on('click', function() {

                $.ajax({
                              url : "<?php echo base_url('admin/action_project/deleteApp') ?>",
                              type : "POST",
                              data: {id : $id},
                              success : function(data){
                                $('#loading').hide();                               

                                if(data == '1')
                                {
                                  $('#msg').html('Đã xóa ứng dụng thành công');
                                  setTimeout(function () { 
                                    window.location.reload();
                                  }, 1000);
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
            });
        });
    </script>
