		<div class="navbar">
      <div class="navbar-inner">
				<div class="container row-fluid head">
					<a class="brand" href="<?php echo base_url(); ?>"><img src="<?php echo  base_url('themes/img/kimi.png'); ?>"/></a>
					<ul class="flag pull-right">
						<li><a class="flag" lang="vi" href="javascript:void(0)"><img src="<?php echo base_url('themes/img/flag/1.png'); ?>"></a></li>
						<li><a class="flag" lang="en" href="javascript:void(0)"><img src="<?php echo base_url('themes/img/flag/2.png'); ?>"></a></li>
						<li><a class="flag" lang="in" href="javascript:void(0)"><img src="<?php echo base_url('themes/img/flag/3.png'); ?>"></a></li>
						<li><a class="flag" lang="po" href="javascript:void(0)"><img src="<?php echo base_url('themes/img/flag/4.png'); ?>"></a></li>
						<li><a class="flag" lang="cn" href="javascript:void(0)"><img src="<?php echo base_url('themes/img/flag/5.png'); ?>"></a></li>
					</ul>
                    <script>
                        $(document).ready(function() {
                            
                            $('a.flag').on('click', function() {
                                var $lang = $(this).attr('lang');    
                                $.ajax({
                                    url:  "<?php echo base_url('home/seturllang'); ?>",
                                    type: "get",
                                    data: "lang="+$lang,
                                    success: function() {
                                        window.location.reload();
                                    }
                                });   
                            });
                        });
                    </script>
                    
					<div class="clearfix"></div>
					<?php
						if($username == '')
						{
					?>
					<p class="pull-right"><a href="<?php echo base_url('register.html') ?>"> <i class="icon-user"></i> <?php echo $this->lang->line('register'); ?></a></p>
					<p class="pull-right" style="margin-right: 10px"><a href="<?php echo base_url('login.html') ?>"> <i class="icon-paper-plane"></i> <?php echo $this->lang->line('login'); ?></a></p>
					<?php
						}
						else
						{
					?>
					<p class="pull-right"> <a href="<?php echo base_url('logout.html') ?>"><?php echo $this->lang->line('logout'); ?></a></p>
					<p class="pull-right" style="margin-right: 10px"> <a href="">Welcome: <?php echo $username; ?></a></p>
					<?php
						}
					?>
				</div>
        <div class="container row-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
          <ul class="nav nav-collapse">
            <li><a href="<?php echo base_url(); ?>" class="active"><?php echo $this->lang->line('home'); ?></a></li>
            <li><a href=""><?php echo $this->lang->line('intro'); ?></a></li>
            <li><a href="<?php echo base_url('app.html') ?>"><?php echo $this->lang->line('app'); ?></a></li>
            <li><a href=""><?php echo $this->lang->line('statistic'); ?></a></li>
						<li><a href="<?php echo base_url('faq.html') ?>"><?php echo $this->lang->line('faq'); ?></a></li>
          </ul>
          <!-- Everything you want hidden at 940px or less, place within here -->         
        </div>
      </div>
    </div>
		<div class="bottom-tear"></div>
