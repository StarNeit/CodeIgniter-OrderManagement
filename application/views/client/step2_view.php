
<section class="container wizard-content care-needs">
	<div class="row">
		<div class="col-xs-12">
			<ul class="wizard-steps">
				<li class="selected">
					<a href="javascript:void(0)">
						<span class="fa fa-user"></span>
						<span>About Recipient</span>
					</a>
				</li>
				<li class="selected">
					<span class="fa fa-th-list"></span>
					<span>Care Needs</span>
				</li>
				<li>
					<span class="fa fa-clock-o"></span>
					<span>First Care</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>HOW CAN WE HELP YOU?</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			
			
			<?=form_open(client_url('wizard/save_step2'), 'class="care-needs-form" onsubmit="return SendForm(this)"')?>

			<div class="about-info personal">
				<h3>Where do you want us to offer care?</h3>
				<div id="message"></div>
				<ul>
					<li class="half">
						<ul>
							<li>
								<label for="postal">Postal Code</label>
								<input type="text" name="postal_code" value="<?=$case->postal_code?>"  placeholder="478202">
							</li>
							<li>
								<label for="unit">Unit No.</label>
								<input type="text" name="unit" value="<?=$case->unit?>" placeholder="#01-01">
							</li>
							<li>
								<label for="block">Block No.</label>
								<input type="text" name="block" value="<?=$case->block?>" placeholder="202">
							</li>
							<li>
								<label for="street">Street</label>
								<input type="text" name="street" value="<?=$case->street?>" placeholder="Choa Chu Kang Ave 10">
								<input type="hidden" name="location_id" value="<?=$case->location_id?>"/> 
							</li>
						</ul>
					</li>
				</ul>
				<h3>CarePro Preferences</h3>
				<ul>
					<li>
						<label for="gender">Gender</label>
						<?=form_dropdown('gender_pref', gender_options(), $case->gender_pref);?>
					</li>
				</ul>
				<p>Do you require 24hr Care/Live-in care?</p>

				<div class="check-button">
					<label>
						<?=form_radio("full_care", 1, $case->full_care)?>
						<span></span><span>Yes</span>
					</label>
					<label>
						<?=form_radio("full_care", 0, !$case->full_care)?>
						<span></span><span>No</span>
					</label>
				</div>
				<p>Do you have any language requests?</p>
				<div class="err err_language"></div>
				<ul class="check-list clearfix">
					<?foreach(languages_array() as $language):?>
					<li>
						<label>
							<input type="checkbox" name="language[]" value="<?=$language?>" <?=in_array($language, $case->languages) ? 'checked' : ''?>/>
							<span></span> 
							<?=$language?>
						</label>
					</li>
					<?endforeach?>   
				</ul>
			</div>


			<h3>Type of Care</h3>	
                        <?if($case->id==''):?>
                            <? $this->load->view('includes/services_view', array('skills' => $case->skills))?>
                        <?else:?>
                            <p>*Note Please contact with homage if you need extra services</p>
                            <? $this->load->view('includes/services_view', array('skills' => $case->skills,'readonly'=>true))?>
                        <?endif?>		
			

			
			<div class="instruction">
				<label>Special Instruction</label>
				<textarea name="special_instructions" cols="30" rows="10"><?=$case->special_instructions?></textarea>
			</div>

			<div class="clearfix">
				<input type="hidden" name="id" value="<?=$case->id?>" />
				<input type="hidden"  name="recipient_id" value="<?=$case->recipient_id?>" />

				<a href="<?=client_url("wizard/step1a")?>" class="btn-main btn-back">Back</a>
				<button class="btn-main btn-next">Next</button>
			</div>
		</div>
		

		<?=form_close()?>
	</div>


</section>
