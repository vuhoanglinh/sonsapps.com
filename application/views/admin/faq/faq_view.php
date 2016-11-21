<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li class="active">Faq</li>
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
                  <a href="<?php echo base_url('admin/faq/add.html'); ?>">
                  <img src="<?php echo base_url('/themes/img/Apps-Dialog-Add-icon.png'); ?>">
                  </a>
                    <h3>Thêm câu hỏi</h3>

                </div>

                <div class="item darkCyan">
                  <a href="<?php echo base_url('admin/faq/lists.html'); ?>">
                    <img src="<?php echo base_url('/themes/img/app-help-icon.png'); ?>">
                  </a>
                    <h3>Danh sách câu hỏi</h3>
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