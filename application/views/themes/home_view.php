<div style="background: url('<?php echo base_url('themes/img/478f6b7b.bg.jpg'); ?>')">
  <div class="container profile">
    <div class="span6 no_margin_left">
      <h1 class="main-color"><?php echo $this->lang->line('subject_home'); ?></h1>
      <a href="<?php echo base_url('app.html'); ?>" class="btn btn-large main-bg"><?php echo $this->lang->line('join_now_home'); ?> </a>
      <a href="#" class="btn btn-large main-bg"><?php echo $this->lang->line('more_info_home'); ?> </a>
    </div>
    <div class="span6">
      <!-- 16:9 aspect ratio -->
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="//www.youtube.com/embed/xAP8CSMEwZ8"></iframe>
      </div>

<!-- 4:3 aspect ratio -->
    </div>
  </div>
</div>
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
        <li>
          <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url('themes/img/dummy.png') ?>" title="Image 01"><img src="<?php echo base_url('themes/img/dummy.png') ?>" /></a></div>
          </li>
           <li>
          <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url('themes/img/dummy.png') ?>" title="Image 01"><img src="<?php echo base_url('themes/img/dummy.png') ?>" /></a></div>
          </li>
           <li>
          <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url('themes/img/dummy.png') ?>" title="Image 01"><img src="<?php echo base_url('themes/img/dummy.png') ?>" /></a></div>
          </li>
           <li>
          <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url('themes/img/dummy.png') ?>" title="Image 01"><img src="<?php echo base_url('themes/img/dummy.png') ?>" /></a></div>
          </li>
      </ul>
     
  </div>
