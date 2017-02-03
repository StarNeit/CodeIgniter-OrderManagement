<div class="page-content">
	
	<?php $this->load->view("admin/client/client_breadcrumbs");?>

	<!-- Page Body -->
	<div class="page-body">
		
		<div class="tabbable">
		
			<?php $this->load->view("admin/client/client_tabs");?>
			

			<div class="tab-content radius-bordered">
				<div class="tab-pane in active">


					<?=form_open(admin_url("client/save_details"), 'onsubmit="return SendForm(this)" class="form-horizontal"')?>

				<div class="form-title">
					Care Recipient(s)&nbsp;&nbsp;<a href="<?=admin_url("recipients/add/".$user->id)?>" class="btn btn-sm btn-follow btn-info">
                                                                        <i class="fa fa-user"></i>
                                                                        Add Recipient
                                                                </a>
				</div>

                                <?php if($recipients!==false):?>
                                    <?php foreach($recipients as $key=>$value):?>
                                        <div class="profile-container">
                                                <div class="profile-header row">
                                                        <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                                                <img src="<?=get_s3_file('recipient',$value->photo,$value->id,"avatar",'')?>" alt="" class="header-avatar" />
                                                        </div>
                                                        <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                                                                <div class="header-fullname"><?=$value->salutation.' '.$value->first_name.' '.$value->last_name?></div>
                                                                <div>(Relationship to Client: <?=$value->relationship?>)</div>
                                                                <div class="header-information">
                                                                        <?=$value->medical_condition?>
                                                                </div>
                                                                <br/>
                                                                <a href="<?=admin_url('recipients/details/'.$value->case_id)?>" class="btn btn-palegreen btn-sm btn-follow">
                                                                        <i class="fa fa-user"></i>
                                                                        View Profile
                                                                </a>
                                                        </div>
                                                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                                                                <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                                                <div class="stats-value palegreen">-</div>
                                                                                <div class="stats-title">UPCOMING</div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                                                <div class="stats-value info">-</div>
                                                                                <div class="stats-title">PENDING</div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                                                <div class="stats-value blueberry">-</div>
                                                                                <div class="stats-title">COMPLETED</div>
                                                                        </div>
                                                                </div>
                                                                <div class="row">
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                                                <i class="glyphicon glyphicon-map-marker"></i> -
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                                                Rating: <strong>-</strong>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                                                Age: <strong><?=GetAge($value->dob)?></strong>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                    <hr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <div align="center">No records found!</div>
                                <?php endif;?>
			</div>
		</div>
		

	</div>
	<br/><br/>
	<!--/tabs-->
</div>
