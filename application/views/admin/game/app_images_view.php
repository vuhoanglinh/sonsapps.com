<script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<?php foreach ($app as $app) {
   # code...
?>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application/start'); ?>">Ứng dụng đang hoạt động</a> <span class="divider">/</span></li>
            <li class="active">Ảnh: <?php echo  $app->projectName; ?></li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height">	
      <div class="row-fluid">    
		<div class="span12">
            <h2>Ảnh screenshot: </h2>
            <?php echo form_open(base_url('admin/action_project/edit_app_image'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
            <div class="row-fluid">                 
                    <label>Ảnh:</label>
                    <input type="text" id="txtImage" name="txtImage"  placeholder="Hình ảnh ứng dụng" maxLength="255" value=""><span class="add-on">
                    <button type="button" id="btnImage" class="btn" style="margin-bottom: 10px;"><img src="<?php echo base_url(); ?>themes/img/Arrow-upload-2-icon.png" /></button>    
                <label for="txtImage"></label>
            </div>
            <br>
            <input type="submit" class="btn btn-large" id="btnSubmit" style="margin-right: 10px;" value="Thêm hình ảnh">
            <input type="button" class="btn btn-large" value="Hủy" id="btnReset" style="margin-right: 10px;">
            <a href="<?php echo base_url('admin/application/start'); ?>" class="btn btn-large">Quay lại</a>
            <input type="hidden" name="hd_action" id="hd_action" value="insert">
            <input type="hidden" name="hd_imageId" id="hd_imageId" value="0">
            <input type="hidden" name="hd_appId" id="hd_appId" value="<?php echo $app->id; ?>">
            <?php echo form_close();?>
          </div>
        </div>
        
        <!-- list image -->
        <div class="clear-fix"></div>
        
        <div class="row-fluid">
            
            <script type="text/javascript" src="<?php echo base_url('themes/js/jquery.fancybox.js?v=2.1.5') ?>"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('themes/css/jquery.fancybox.css?v=2.1.5') ?>" media="screen" />
            <script>
                    $(document).ready(function() {
                $(".fancybox-thumb").fancybox({
                    helpers	: {
                        title	: {
                            type: 'inside'
                        },
                        overlay : {
                                    css : {
                                        'background' : 'rgba(1,1,1,0.65)'
                                    }
                                }
                    }
                });
            });
                </script>

          <div class="container work">
              <ul class="work-images">
                <?php
                  foreach($app_images as $image) {
                  ?>
                <li style="width:25%">
                  <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo $image->link; ?>"  title="<?php echo $app->projectName; ?>"><img src="<?php echo $image->link; ?>"  /></a>                        
                  </div>
                  <a href="javascript:void(0)" class="btn" action="update" appid="<?php echo $app->id; ?>" imageid="<?php echo $image->id; ?>" link="<?php echo $image->link; ?>" style="margin-top:10px;">Sửa</a>
                  <a href="javascript:void(0)" class="btn" action="delete" appid="<?php echo $app->id; ?>" imageid="<?php echo $image->id; ?>" link="<?php echo $image->link; ?>" style="margin-top:10px;">Xóa</a>
                  </li>          
                 <?php
                    };//Endforeach
                  ?>  
              </ul>

          </div>
    </div>
             
</div>

<script>
$(document).ready(function(){
    
    function SetFileField(fileUrl) {
        //fileUrl   =   fileUrl.replace('<?php echo base_url(); ?>','');
        jQuery('#txtImage').val(fileUrl);
    } 
     $("#btnImage").on("click", function(){
        var finder = new CKFinder();
        finder.selectActionFunction = SetFileField;
        finder.popup();
    })
                  
    //Update
    $('a[action="update"]').on('click', function(){
        var $a  =   $(this);
        $('#hd_action').val('update');        
        $('#hd_imageId').val($a.attr('imageid'));
        $('#txtImage').val($a.attr('link'));
        $('#btnSubmit').val('Cập nhật');
        $("#txtImage").parent().removeClass('error');
        $("#txtImage").focus();
        $("label[for='txtImage']").html('');
        
    });
    
    //Delete
    $('a[action="delete"]').on('click', function(){
        var a = $(this);
        $.ajax({
                      url: "<?php echo base_url('admin/action_project/delete_app_image'); ?>",
                      type: 'post',
                      data: 'id=' + a.attr('imageid'),                     
                      success: function(data) 
                      { 
                          if(data == '1')
                          {
                              window.location.reload();
                          }
                      }
        });
        
    });
     $('#btnReset').on('click', function(){
        $('#hd_action').val('insert');
        $('#hd_imageId').val('0');
        $('#txtImage').val('');
        $('#btnSubmit').val('Thêm hình ảnh');
     });
    
     $("form#frm").on('submit', function(){
                 
                  var from = $(this);
                  if($('#txtImage').val() == "")
                  {
                        var $msg    =   "Bạn phải nhập thông tin này.";
                        $("#txtImage").parent().addClass('error');
                        $("#txtImage").focus();
                        $("label[for='txtImage']").html($msg);
                  }
                  else
                  {
                    $.ajax({
                      url: from.attr('action'),
                      type: from.attr('method'),
                      data: from.serialize(),
                      dataType: 'json',                     
                      success: function(data) { 
                        if(data.status == '1')
                        {               
                          window.location.reload(); 
                        }
                        else
                        {
                          $("#txtImage").parent().addClass('error');
                          $("#txtImage").focus();
                          $("label[for='txtImage']").html(data.msg);
                        }               
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {                                
                          $("label[for='txtImage']").html('Đường truyền gặp sự cố, thao tác không thể thực hiện được.');                         
                      }
                    });
                  }
                    return false;

                });
    
    

});
</script>
<?php 
}//Endforeach
?>