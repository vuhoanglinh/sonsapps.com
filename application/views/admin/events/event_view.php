<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url('admin'); ?>">Bảng điều khiển</a> <span class="divider">/</span></li>
            <li class="active">Sự kiện</li>
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
                  <a href="<?php echo base_url('admin/events/add.html'); ?>">
                  <img src="<?php echo base_url('/themes/img/Add-Event-icon.png'); ?>">
                  </a>
                    <h3>Thêm câu hỏi</h3>

                </div>

                <div class="item yellowLight">
                  <a href="<?php echo base_url('admin/events/lists.html'); ?>">
                    <img src="<?php echo base_url('/themes/img/Events-Calendar-icon.png'); ?>">
                  </a>
                    <h3>Danh sách sự kiện</h3>
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