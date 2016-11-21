  <script src="<?php echo base_url(); ?>themes/js/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>themes/js/ckfinder/ckfinder.js"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('admin/application'); ?>">Ứng dụng</a> <span class="divider">/</span></li>
            <li class="active">Đăng ứng dụng cho thành viên</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height2">	
      <div class="row-fluid">
		    <div class="row">
            <div class="span12">
              <div class="span8">
                <h2>Cập nhật app cho users</h2>
                <?php echo form_open_multipart(base_url('admin/game/upfile_excel'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                  <div id="row" class="row-fluid">
                    <label>File:</label>
                      <?php 
                        if($success != '')
                        {
                            echo '<label style="color: red">'.$success.'</label>';
                        }                      
                      ?>
                    <div id="dropzone" class="fileUpload">
                      <div class="dropzone">
                        <span id="file">Kéo thả hoặc click chuột</span>
                        <input class="upload" type="file" id="File" name="spreadsheet">
                      </div>
                    </div>
                  </div>

                  <div class="row-fluid" style="display:none">
                    <label>File excel:</label>
                    <input type="text" id="txtFile" name="txtFile" style="width: 60%;" placeholder="File excel" maxLength="255" disabled><span class="add-on">
                    <button type="button" id="btn" class="btn" style="margin-bottom: 10px;"><img src="<?php echo base_url(); ?>themes/img/Arrow-upload-2-icon.png" /></button>
                  </div>
                  <br/>
                  <button type="submit" style="margin-right: 10px;" class="btn btn-large"> Upload</button> <button type="reset" class="btn btn-large"> Hủy</button>
                <?php echo form_close(); ?>
              </div>
              <div class="span4 padding">
                <img src="<?php echo base_url(); ?>themes/img/Cloud3.png">
              </div>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                function SetFileField(fileUrl) {
                    //fileUrl   =   fileUrl.replace('<?php echo base_url(); ?>','');
                    jQuery('#txtFile').val(fileUrl);
                  }
                  $("#btn").on("click", function(){
                    var finder = new CKFinder();
                    finder.selectActionFunction = SetFileField;
                    finder.popup();
                  });

                $("input[type='file']").change(function(){
                  name =  $(this).val();
                  $("#file").html(name);
                });
              });
            </script>
        </div>
      </div>
    </div>
