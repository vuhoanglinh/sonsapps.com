<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li class="active">Ứng dụng</li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height2">
      <div class="row-fluid">
		    <div class="row">
            <div class="span12">

              <div id="owl-example" class="owl-carousel">

                <div class="item steelGray">
                  <a href="application/upload.html">
                  <img src="<?php echo base_url('/themes/img/arrow-upload-icon.png'); ?>">
                  </a>
                    <h3>Thêm app</h3>

                </div>

                <div class="item zombieGreen">
                  <a href="application/project.html">
                    <img src="<?php echo base_url('/themes/img/info-icon.png'); ?>">
                  </a>
                    <h3>Thông tin project</h3>
                </div>

                <div class="item dodgerBlue">
                  <a href="application/users_app.html">
                    <img src="<?php echo base_url('/themes/img/MS-Messenger-icon.png'); ?>">
                  </a>
                    <h3>Đăng app cho người dùng</h3>
                </div>

                <div class="item yellow">
                  <a href="application/start.html">
                    <img src="<?php echo base_url('/themes/img/Games-alt-icon.png'); ?>">
                  </a>
                    <h3>App phân phối</h3>
                </div>

                <div class="item orange">
                  <a href="application/stop.html">
                    <img src="<?php echo base_url('/themes/img/games-icon.png'); ?>">
                  </a>
                    <h3>App đã dừng</h3>
                </div>

              </div>
          </div>
        </div>
		</div>
    </div>
    <!--END: Profile container-->
    <script type="text/javascript">
    	$(document).ready(function() {

		  $("#owl-example").owlCarousel();

		});
    </script>
