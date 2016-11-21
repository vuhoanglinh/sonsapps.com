<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/faq.html'); ?>">Faq</a> <span class="divider">/</span></li>
            <li class="active">Danh sách câu hỏi</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height2">
      <div class="row-fluid">
		<div class="row">
            <div class="span12">
            	<h2>Danh sách câu hỏi</h2>
                <p class="pull-right"><a href="<?php echo base_url('admin/faq.html'); ?>" class="btn btn-large">Quay lại</a></p>
                <div class="clearfix"></div>

            	<form action="" method="post" class="pull-right">   
                    <label>Lọc theo trạng thái:</label>               
                    <select id="slType" style="padding: 6px;">   
                      <option value="1" <?php echo ($status == 1)? 'selected' : '';?>>Hiện</option>
                      <option value="0" <?php echo ($status == 0)? 'selected' : '';?>>Ẩn</option> 
                      <option value="">Hiện tất cả</option>                     
                    </select> 
                    <button type="button" id="filterStatus" class="btn" style="margin-bottom:10px;">Lọc</button>                    
                </form>
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
              <script type="text/javascript">
                $(document).ready(function() {                  
                  $('#filter').on('click', function(){          

                     window.location.href   = "<?php echo base_url('admin/faq/lists'); ?>?lang=" + $('#slLang').val();
                      
                                                        
                  });

                  $('#filterStatus').on('click', function(){  
                      if($('#slType').val() == "") 
                      {
                        window.location.href   = "<?php echo base_url('admin/faq/lists');?>";
                      }
                      else
                      {
                        window.location.href   = "<?php echo base_url('admin/faq/lists');?>/?status=" + $('#slType').val();
                      }
                  });

                });
              </script>
              <form action="" name="form" method="post">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Câu hỏi</th>
                    <th>Alias</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Ngôn ngữ</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                              foreach($faq as $row) {
                        ?>
                  <tr>
                    <td style="width: 200px;"><?php echo $row->question; ?></td>
                    <td style="width: 200px;"><?php echo $row->alias; ?></td>
                    <td><span class="label label-default" style="cursor: pointer;" action="stt" data="<?php echo $row->index; ?>" dataid="<?php echo $row->id; ?>"><?php echo $row->index; ?></span></td>
                    <td><span action="status" style="cursor: pointer;" class="label <?php echo ($row->status == 1) ? 'label-success' : 'label-warning';?>" data="<?php echo ($row->status == 1) ? 0: 1; ?>" dataid="<?php echo $row->id; ?>"><?php echo ($row->status == 1) ? 'Hiện' : 'Ẩn';?></span></td>
                    <td style="text-align:center"><?php 
                                  switch($row->lang)
                                  {
                                      case 'vietnamese' : echo '<img src="'.base_url('themes/img/flag/1.png').'" />';break;
                                      case 'english' : echo '<img src="'.base_url('themes/img/flag/2.png').'" />';break;
                                      case 'indonesia' : echo '<img src="'.base_url('themes/img/flag/3.png').'" />';break;
                                      case 'portugal' : echo '<img src="'.base_url('themes/img/flag/4.png').'" />';break;
                                      case 'china' : echo '<img src="'.base_url('themes/img/flag/5.png').'" />';break;
                                  }
                                  ?></td>
                            <td><?php echo mdate($datestring, strtotime($row->create_at)); ?></td>
                    <td><?php echo mdate($datestring, strtotime($row->update_at)); ?></td>
                    <td style="width: 150px;"><a href="<?php echo base_url('admin/faq/edit/'.$row->id); ?>" class="btn">Chỉnh sửa</a> 
                      <a action="del" href="javascript:void(0)" data="<?php echo $row->id; ?>" class="btn">Xóa</a></td>
                  </tr>
                        <?php } //Endforeach?>
                </tbody>
              </table>
            </form>
                  <script type="text/javascript">
                    $(document).ready(function(){
                      var $status  =   "";
                      var $id      =   "";
                      var $object  =   "";
                      var $type    =   "";
                     
                      $('body').on('click', "span[action='stt']", function(){

                          var a     = $(this);
                          $('#stt').val(a.attr('data'));
                          $id       = a.attr('dataid');
                          $object   = a;
                          $type     = 2;
                          $('#showMsg1').click(); 

                      });

                      $('body').on('click', "span[action='status']", function(){

                          var a    =   $(this);
                          $status  =   a.attr('data');
                          $id      =   a.attr('dataid');
                          $object  =   a;
                          $type    =   0;
                          $('#msg').html('Bạn có muốn thay đổi trang thái câu hỏi này không?');
                          $('#showMsg').click(); 

                      });
                      $('body').on('click', "a[action='del']", function(){

                          var a        = $(this);
                          $id      =   a.attr('data');
                          $object  =   a;
                          $type    =   1;
                          $('#msg').html('Bạn có chắc chắn xóa câu hỏi này không?');
                          $('#showMsg').click(); 
                         

                        });

                      $('#btnMsg1').on('click', function() {
                              $status   = $('#stt').val();

                                $.ajax({
                                  url : "<?php echo base_url('admin/action_faq/updateSTT') ?>",
                                  type : "POST",
                                  data: {status: $status, id : $id},
                                  dataType: 'json',
                                  beforeSend: function() {
                                      $('#loading2').show();  
                                  },
                                  success : function(data){                              

                                    if(data.info == '1')
                                    {
                                      $object.html($status);
                                      $object.attr('data', $status);
                                      setTimeout(function () { 
                                        $('#loading2').hide(); 
                                        $('.close').click();
                                      }, 500);
                                    }
                                    else
                                    {
                                      $('msg1').html('Thao tác dữ liệu xảy ra lỗi, xin vui lòng thử lại.');
                                     setTimeout(function () { 
                                        $('.close').click();
                                      }, 500);
                                    }
                                    
                                  }
                                });
                      });

                      $('#btnMsg').on('click', function() {
                        $('#loading').show();
                        switch($type)
                        {
                          case 0:
                                 $.ajax({
                                    url : "<?php echo base_url('admin/action_faq/updatestatus') ?>",
                                    type : "POST",
                                    dataType : "json",
                                    data: {status : $status, id : $id},
                                    success : function(data){
                                      $('#loading').hide();
                                      if(data.info == '1')
                                      {
                                        if(data.status == '0')
                                        {      
                                          $object.addClass('label-warning');
                                          $object.removeClass('label-success');   
                                          $object.html('Ẩn');
                                          $object.attr('data','1');  
                                        }
                                        else
                                        {   
                                          $object.removeClass('label-warning');
                                          $object.addClass('label-success');                 
                                          $object.html('Hiện');
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
                                  url : "<?php echo base_url('admin/action_faq/delete') ?>",
                                  type : "POST",
                                  data: {id : $id},
                                  success : function(data){
                                    $('#loading').hide();                               

                                    if(data == '1')
                                    {
                                      $('#msg').html('Đã xóa câu hỏi thành công');
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
            <div class="span12 text-center" style="margin-left: 0;">
              <?php echo $pagging; ?>
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

    <a href="#myMsg1" id="showMsg1" role="button" data-toggle="modal" style="display: none;"></a>
    <div id="myMsg1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">        
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-mail"></i>THÔNG BÁO</h3>
      </div>
      <div class="modal-body">
        <p id="msg1">Thay đổi số thứ tự của câu hỏi này?</p>
        <form action="" method="post">
          <input type="text" value="" id="stt" name="stt" id="stt" />
        <p id="loading2" style="display:none;"><img src="<?php echo base_url(); ?>/themes/img/496.gif" width="32px" /></p>
        <button type="button" id="btnMsg1" class="btn"><i class="icon-paper-plane"></i> Cập nhật</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Hủy bỏ</button>        
        </form>
      </div>
    </div>
    <script>
      $('#myMsg1').modal('hidden');
      $('#myMsg').modal('hidden');
    </script>