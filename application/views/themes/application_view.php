<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>           
            <li class="active"><?php echo $this->lang->line('app'); ?></li>
        </ul>
    </div>
</div>

<div class="container container-min-height">
  <ul class="nav nav-tabs" id="tab_data_game">
    <li class="active"><a href="#running"><b> <?php echo $this->lang->line('app_start'); ?></b></a></li>
    <li class=""><a href="#stopped"><b><?php echo $this->lang->line('app_stop'); ?></b></a></li>
    <li class=""><a href="#system"><b><?php echo $this->lang->line('app_system'); ?></b></a></li>
  </ul>
  <div class="row-fluid">
    <div class="tab-content">
      <div class="tab-pane active" id="running"><!-- start tab running -->

        <div class="row-fluid applications">

          <?php 
            foreach ($app_enable as $row) {   
          ?>
          <?php echo ($row->class != '') ? '<div class="clearfix"></div>' : ''; ?>
          <div class="span6 thumbnail pull-left <?php echo $row->class; ?> ">
            <h4> <a href="<?php echo base_url('app').'/'.$row->id; ?>"> <?php echo $row->projectName; ?></a> </h4>
            <div class="span4"> <a href="<?php echo base_url('app').'/'.$row->id; ?>"> <img src="<?php echo ($row->logo != "") ? $row->logo : base_url(IMAGE_DUMMY_SMALL); ?>" style="width: 100%"> </a> </div>
            <div class="span6">
              <p><?php echo $this->lang->line('app_id'); ?>: <?php echo $row->id; ?></p>   
              <p><?php echo $this->lang->line('app_status'); ?>: <span class="label label-success"><?php echo $this->lang->line('app_status_start'); ?></span></p>
              <p><?php echo $this->lang->line('app_forms'); ?>: <?php echo $row->forms; ?></p>              
              <p><?php echo $this->lang->line('app_description'); ?>: <span class="location_pub tooltip_lc" data-original-title="<?php echo $this->lang->line('app_description'); ?>" data-toggle="popover" data-placement="top" data-content="<?php echo $row->short_description; ?> "><?php echo $row->short_description; ?></span></p>
            </div>          
          </div> 
            <?php 
              }//Endforeach
            ?> 
        </div>
      </div>
      <!-- end tab running -->
      <div class="tab-pane" id="stopped"> <!-- start tab stop -->
        
        <div class="row-fluid applications">
          <?php 
            foreach ($app_disable as $row) {           
          ?>
          <?php echo ($row->class != '') ? '<div class="clearfix"></div>' : ''; ?>
          <div class="span6 thumbnail pull-left <?php echo $row->class; ?> ">
            <h4> <a href="<?php echo base_url('app').'/'.$row->id; ?>"> <?php echo $row->projectName; ?></a> </h4>
            <div class="span4"> <a href="<?php echo base_url('app').'/'.$row->id; ?>"> <img src="<?php echo ($row->logo != "") ? $row->logo : base_url(IMAGE_DUMMY_SMALL); ?>" style="width: 100%"> </a> </div>
            <div class="span6">
              <p><?php echo $this->lang->line('app_id'); ?>: <?php echo $row->id; ?></p> 
              <p><?php echo $this->lang->line('app_status'); ?>: <span class="label label-waring"><?php echo $this->lang->line('app_status_stop'); ?></span></p>
              <p><?php echo $this->lang->line('app_forms'); ?>: <?php echo $row->forms; ?> <i class="fa fa-android" style="font-size: 20px; color: #b3c833;"></i> </p>              
              <p><?php echo $this->lang->line('app_description'); ?>: <span class="location_pub tooltip_lc" data-original-title="<?php echo $this->lang->line('app_description'); ?>" data-toggle="popover" data-placement="top" data-content="<?php echo $row->short_description; ?> "><?php echo $row->short_description; ?></span></p>
            </div>          
          </div> 
            <?php 
              }//Endforeach
            ?> 
          <div class="clearfix"></div>
        </div>
      </div>
      <!-- end tab stop --> 
      <script type="text/javascript" src="<?php echo base_url('themes/js/jquery.fileDownload.js') ?>"></script>

      <div class="tab-pane" id="system">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th><?php echo $this->lang->line('app_id') ?></th>
              <th><?php echo $this->lang->line('app_name'); ?></th>
              <th><?php echo $this->lang->line('app_status'); ?></th>
              <th><?php echo $this->lang->line('app_forms'); ?></th>
              <th><?php echo $this->lang->line('app_description'); ?></th>
              <th><?php echo $this->lang->line('app_download'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($app_not_use as $row) {
            ?>
            <tr>
              <td><?php echo $row->id; ?></td>
              <td style="width: 30%;"><div class="span2"><img src="<?php echo ($row->logo != "") ? $row->logo : base_url(IMAGE_DUMMY_SMALL); ?>" style="width: 100%"></div> <div class="span10"><?php echo $row->projectName; ?></div></td>
              <td><span class="label <?php echo ($row->status == 1) ? 'label-success' : 'label-waring'; ?>">
                <?php echo ($row->status == 1) ? $this->lang->line('app_status_start') : $this->lang->line('app_status_stop');  ?></span></td>
              <td><?php echo $row->forms; ?></td>
              <td style="width: 30%;"><span class="location_pub tooltip_lc" data-original-title="<?php echo $this->lang->line('app_description'); ?>" data-toggle="popover" data-placement="top" data-content="<?php echo $row->short_description; ?> "><?php echo $row->short_description; ?></span></td>
              <td><a class="fileDownload" href="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/1'; ?>"><?php echo $this->lang->line('download'); ?></a></td>
            </tr>
            <?php
              } //Endforeach
            ?>
          </tbody>
        </table>
        <script>
          $(document).on("click", "a.fileDownload", function () {
              $('#btnMsg').click();
              $.fileDownload($(this).prop('href'))
                  .done(function () {  $('#msg').html('<?php echo $this->lang->line("loading"); ?>'); })
                  .fail(function () {  $('#msg').html('<?php echo $this->lang->line("error") ?>'); });
              
              return false; //this is critical to stop the click event which will trigger a normal file download!
          });
        </script>
      </div>
    </div>
  </div>
</div>

<a href="#myModal" id="btnLog" role="button" data-toggle="modal" style="display: none;"></a>
<a href="#myModalMsg" id="btnMsg" role="button" data-toggle="modal" style="display: none;"></a>
     <!-- Modal -->
    <div id="myModalMsg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel1"><i class="icon-mail"></i> <?php echo $this->lang->line('message'); ?></h3>
      </div>
      <div class="modal-body">
        <p id="msg"><?php echo $this->lang->line('loading'); ?></p>        
      </div>
    </div>
<script>
    $(document).ready(function(){
        $('#tab_data_game a').click(function(e){
            e.preventDefault();
            $(this).tab('show');
        }); $(".info_install,.info_price,.tooltip_lc").popover({
            animation: true,
            trigger: 'hover',
            html :true,
            delay: { show: 300, hide: 800 }
        })
    })
</script>
<style>
    .popover{
        max-width:600px !important;
        z-index: 99999999999999 !important;
    }
</style>
