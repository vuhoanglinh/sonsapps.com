	<div class="navbar" style="padding-bottom: 50px; background-color: #f5f5f5;">
      <div class="navbar-inner">
        <div class="container"> 
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
            <span class="icon-bar"></span> <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
          </a> 
          <a class="brand" href="<?php echo base_url('admin/index.html'); ?>">
            <img src="<?php base_url(); ?>/themes/img/user.jpg"/><br />
            Welcome: <?php echo $fullname; ?>
          </a>
          <ul class="nav nav-collapse pull-right">
            <li><a href="<?php echo base_url(); ?>admin/index.html" class="active">Bảng điều khiển</a></li>
            <li><a href="<?php echo base_url(); ?>admin/users.html">Thành viên</a></li>
            <li><a href="<?php echo base_url(); ?>admin/application.html">Ứng dụng</a></li>
            <li><a href="<?php echo base_url(); ?>admin/faq.html">Faq</a></li>
            <li><a href="<?php echo base_url(); ?>admin/events.html">Sự kiện</a></li>
            <li><a href="<?php echo base_url(); ?>admin/Logs.html">Logs</a></li>
            <li><a href="<?php echo base_url(); ?>admin/logout.html">Đăng xuất</a></li>
          </ul>
          <!-- Everything you want hidden at 940px or less, place within here -->
          <div class="nav-collapse collapse">
            <!-- .nav, .navbar-search, .navbar-form, etc -->
          </div>
        </div>
      </div>
    </div>