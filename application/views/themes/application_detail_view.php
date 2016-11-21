<?php 
    foreach($app as $row) :
?>
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
<script type="text/javascript" src="<?php echo base_url('themes/js/jquery.fileDownload.js') ?>"></script>
<div class="row-fluid" style="background-color: #f5f5f5;">
    <div class="container">    
        <ul class="breadcrumb" style="margin-bottom:0">
            <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <span class="divider">/</span></li>
            <li><a href="<?php echo base_url('app.html') ?>"><?php echo $this->lang->line('app'); ?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $row->projectName; ?></li>
        </ul>
    </div>
</div>
<div class="container min-height">
    <div class="row-fluid" style="margin-top: 15px">
        <div class="span12">
            <div class="span2">
                <img src="<?php echo $row->logo; ?>">
            </div>
            <div class="span4">
              <h3 style="text-transform: uppercase; color:#0054a6"><?php echo $row->projectName; ?></h3>
              <p><?php echo $this->lang->line('app_id'); ?>: <?php echo $row->id; ?></p> 
              <p><?php echo $this->lang->line('app_status'); ?>: <span class="label label-success"><?php echo $this->lang->line('app_status_start'); ?></span></p>
              <p><?php echo $this->lang->line('app_forms'); ?>: <?php echo $row->forms; ?> <i class="fa fa-android" style="font-size: 20px; color: #b3c833;"></i> </p>              
              <p><?php echo $this->lang->line('app_description'); ?>: <span class="location_pub tooltip_lc" data-original-title="<?php echo $this->lang->line('app_description'); ?>" data-toggle="popover" data-placement="top" data-content="<?php echo $row->short_description; ?> "><?php echo $row->short_description; ?></span></p>                    
            </div>
            <div class="span6">
                <?php echo form_open(base_url('home/addkeymod'), array('id' => 'frm','novalidate' => 'novalidate')); ?>
                    <label><?php echo $this->lang->line('keymod'); ?>:</label>
                    <input type="text" id="txtKeymod" name="txtKeymod" value="<?php echo $keymod; ?>" placeholder="<?php echo $this->lang->line('keymod_field'); ?>">                <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-large"><i class="icon-paper-plane"></i> <?php echo $this->lang->line('add_keymod'); ?></button>
                    <input type="hidden" name="app" id="app" value="<?php echo $row->id; ?>" >
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>" >
                <?php echo form_close(); ?>
            </div>
        </div>        
    </div>
    
    <!-- -->
    <ul class="nav nav-tabs" id="tab_data_game">
        <li class="active"><a href="#content"><b> <?php echo $this->lang->line('content'); ?></b></a></li>
        <li class=""><a href="#frame"><b><?php echo $this->lang->line('frame'); ?></b></a></li>
      </ul>
     <div class="row-fluid">
        <div class="tab-content">
            <div class="tab-pane active" id="content"><!-- start tab running -->

                <div class="row-fluid" style="margin-bottom: 20px;">
                    <div class="span12 thumbnail" style="padding: 20px">
                        <div class="tab_item">
                            <label> <b><?php echo $this->lang->line('link_download'); ?>:</b> </label>
                            <p><a class="fileDownload" href="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>"><?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?></a></p>
                        </div>
                        <div class="tab_item work">
                            <label> <b><?php echo $this->lang->line('screen_shot'); ?></b> </label>
                            
                              <ul class="work-images">
                                <?php
                                  foreach($app_images as $image) {
                                  ?>
                                  <li>
                                  <div><a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo $image->link; ?>" link="<?php echo $image->link; ?>"><img src="<?php echo $image->link; ?>"  /></a></div>
                                  </li>          
                                 <?php
                                    };//Endforeach
                                  ?>  
                            </ul>

          
                        </div>
                        
                         <div class="tab_item">
                            <label> <b><?php echo $this->lang->line('content'); ?></b> </label>
                             
                            <div class="content_desc">
                                <?php echo $row->description; ?>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="tab-pane" id="frame"><!-- start tab running -->

                <div class="row-fluid">
                    <div class="span12 thumbnail" style="padding: 20px">
                        <div class="tab_item" style="margin-bottom: 10px">
                            <label> <b><?php echo $this->lang->line('link_download'); ?>:</b></label>
                            <p> <input onclick="this.focus();this.select();" type="text" readonly="" style="width: 100%; height: auto;" value="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>" class="input-large form-control"></p>
                        </div>
                        
                        <div class="tab_item">
                            <label><b><?php echo $this->lang->line('html_code'); ?></b></label>
                            <p> <input onclick="this.focus();this.select();" type="text" readonly="" style="width: 100%; height: auto;" value="<a href='<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>'> <?php echo $row->projectName; ?> </a>" class="input-large form-control"></p>
                        </div>
                        <div class="tab_item">
                            <label><b><?php echo $this->lang->line('before_view'); ?></b></label>
                            <div style="width: 100%; background:#fe4444 !important;padding: 2px; overflow: hidden;"><a class="fileDownload" href="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>" style="float: left !important; margin-right: 5px !important;" ><img src="<?php echo $row->logo; ?>" alt="<?php echo $row->projectName; ?>" title="<?php echo $row->projectName; ?>" style="width: 64px;"></a><h2 style="font-size: 24px !important;padding-right: 20px; padding-top: 20px; !important; margin: 0!important;line-height: 32px !important;" title="<?php echo $row->projectName; ?>"><a class="fileDownload" href="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>" style="color: #FFFFFF !important; text-decoration: none!important;"><?php echo $row->projectName; ?></a></h2></div>
                        </div>
                        
                        <div class="tab_item">
                            <label><b><?php echo $this->lang->line('frame'); ?></b></label>
                            <p>
                                <textarea rows="3" onclick="this.focus();this.select();" readonly="" style="width: 100%; height: auto; min-height: 200px; resize: none" ><div style="width: 100%; background:#fe4444 !important;padding: 2px; overflow: hidden;"><a href="<?php echo base_url('download').'/'.$row->alias.'/'.$row->id.'/'.$user; ?>" style="float: left !important; margin-right: 5px !important;" ><img src="<?php echo $row->logo; ?>" alt="<?php echo $row->projectName; ?>" title="<?php echo $row->projectName; ?>" style="width: 64px;"></a><h2 style="font-size: 24px !important;padding-right: 20px; padding-top: 20px; !important; margin: 0!important;line-height: 32px !important;" title="<?php echo $row->projectName; ?>"><a href="" style="color: #FFFFFF !important; text-decoration: none!important;"><?php echo $row->projectName; ?></a></h2></div></textarea>
                            </p>
                        </div>
                        
                        <div class="tab_item">
                            <label><b><?php echo $this->lang->line('frame_description'); ?></b></label>
                            <p>
                                <textarea rows="3" onclick="this.focus();this.select();" readonly="" style="width: 100%; height: auto; min-height: 200px; resize: none" ><?php echo $row->description; ?></textarea>
                            </p>
                        </div>
                    </div>  
                </div>
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


    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <h3 id="myModalLabel"><i class="icon-mail"></i> <?php echo $this->lang->line('message'); ?></h3>
      </div>
      <div class="modal-body">
        <p id="message"><?php echo $this->lang->line('keymod_success'); ?></p>
        <a href="javascript:void(0)" id="btnclose" class="btn"><?php echo $this->lang->line('close'); ?> </a>
      </div>
    </div>
    <script>
      $('#myModal').modal('hidden');
      $('#myModalMsg').modal('hidden');
    </script>

    <script>
    $(document).on("click", "a.fileDownload", function () {
        $('#btnMsg').click();
        $.fileDownload($(this).prop('href'))
            .done(function () {  $('#msg').html('<?php echo $this->lang->line("loading"); ?>'); })
            .fail(function () {  $('#msg').html('<?php echo $this->lang->line("error") ?>'); });
        
        return false; //this is critical to stop the click event which will trigger a normal file download!
    });

    $(document).ready(function(){
        $('#btnclose').click(function() {                               
                      $('.modal-backdrop').click();
                  });
        $("form#frm").on('submit', function(){
                if($('#txtKeymod').val() != '')
                {
                    var from = $('form#frm');
                    $.ajax({
                          url:  from.attr('action'),
                          type: from.attr('method'),
                          data: from.serialize(),
                          success: function(data) {
                              $('#btnLog').click();
                          }
                    });
                }
                return false;
            });
        
        $('#tab_data_game a').click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    });
    </script>
<?php 
    endforeach;
?>