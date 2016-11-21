<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a></li>
        </ul>
    </div>
</div>
<!--Profile container-->
    <div class="container min-height2">	  
    	<div class="row-fluid">
		    <div class="row">
            <div class="span12">

              <div id="owl-example" class="owl-carousel">

                <div class="item darkCyan">
                  <a href="<?php echo base_url(); ?>">
                  <img src="<?php echo base_url('/themes/img/demo-slides/touch.png'); ?>" alt="Home">
                  </a>
                    <h3>sonsapps.com</h3>
                    <h4>Trở về trang chủ</h4>

                </div>

                <div class="item zombieGreen">
                  	<a href="users.html">
                  		<img src="<?php echo base_url('/themes/img/demo-slides/zombie.png'); ?>" alt="Zombie Browsers - old ones">
              		</a>
                    <h3>Thành viên</h3>
                    <h4>Quản lý thành viên</h4>
                </div>

                <div class="item violet">
                	<a href="application.html"><img src="<?php echo base_url('/themes/img/demo-slides/controls.png'); ?>" alt="Take Control"></a>
                    <h3>Ứng dụng</h3>
                    <h4>Quản lý ứng dụng</h4>
                </div>
                <!--
                <div class="item yellowLight">
                	<a href="">
                  		<img src="<?php echo base_url('/themes/img/demo-slides/feather.png'); ?>" alt="Light">
              		</a>
                    <h3>Thống kê</h3>
                    <h4>Quản lý thống kê</h4>
                </div>
                -->
                <div class="item skyBlue">
                  	<a href="faq.html">
                  		<img src="<?php echo base_url('/themes/img/demo-slides/modern.png'); ?>" alt="Modern Browsers">
              		</a>
                    <h3>Faq</h3>
                    <h4>Câu hỏi nhanh</h4>
                </div>

                <div class="item yellowLight">
                    <a href="<?php echo base_url(); ?>admin/events.html">
                      <img src="<?php echo base_url('/themes/img/Events-Calendar-icon.png'); ?>" alt="Modern Browsers">
                  </a>
                    <h3>Sự kiện</h3>
                    <h4>Quản lý sự kiện</h4>
                </div>

                <div class="item steelGray">
                    <a href="<?php echo base_url(); ?>admin/logs.html">
                      <img src="<?php echo base_url('/themes/img/log-icon.png'); ?>" alt="Modern Browsers">
                  </a>
                    <h3>Logs</h3>
                    <h4>Xem lịch sử logs</h4>
                </div>

                <div class="item forestGreen">
                  	<a href="logout.html">
                  		<img src="<?php echo base_url('/themes/img/inside-logout-icon.png'); ?>" alt="Modern Browsers">
              		</a>
                    <h3>Đăng xuất</h3>
                    <h4>Thoát tài khoản</h4>
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
