<section class="container wizard-content">
    <div class="row">
        <div class="col-xs-12">
            <ul class="wizard-steps">
                <li class="selected">
                    <span class="fa fa-user"></span>
                    <span>About Recipient</span>
                </li>
                <li>
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
            <h2>Who needs care?</h2>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-6">
            <a href="<?=client_url("wizard/step1a")?>" class="btn-main btn-care<?=$who != 'me' ? '-inverse' : ''?>">Loved one</a>
        </div>
        <div class="col-xs-12 col-sm-6">
            <a href="<?=client_url("wizard/step1b")?>" class="btn-main btn-care<?=$who == 'me' ? '-inverse' : ''?>">Myself</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?=form_open(client_url('wizard/save_step1'), 'class="about-info about-recipient" onsubmit="return SendForm(this)"')?>
                
                <div id="message"></div>
                
                <?php if($who != 'me'):?>
                    <div class="relationship">
                        <label for="Relationship">Relationship</label>
                        <?=form_dropdown('relationship', relationship_options(), $item->relationship);?>
                    </div>
             
                    <div class="title-form">Tell us more</div>
                <?php endif;?>
            
                <ul>
                    <?php if($who != 'me'):?>
                    <li>
                        <label for="Salutation">Salutation</label>
                        <?=form_dropdown('salutation', salutation_options(), $item->salutation);?>
                    </li>
                    <li class="half">
                        <ul>
                            <li>
                                <label for="name">First Name</label>
                                <input type="text" name="first_name" value="<?=$item->first_name?>">
                            </li>
                            <li>
                                <label for="surname">Last Name</label>
                                <input type="text" name="last_name" value="<?=$item->last_name?>">
                            </li>
                        </ul>
                    </li>
                    <?php endif;?>
                
                    <li class="half">
                        <ul>
                            <li>
                                <label>Date Of Birth</label>
                                <input type="text" name="dob" value="<?=hdate($item->dob)?>" class="datepicker">
                            <li>
                                <label>Gender</label>
                                <?=form_dropdown('gender', gender_options(), $item->gender);?>
                            </li>
                            <li>
                                <label for="number">NRIC/Passport</label>
                                <input type="text" name="nric" value="<?=$item->nric?>" id="nric" placeholder="S1394942Z">
                            </li>
                              <li  class="race">
                                  <label for="race">Race</label>
                                  <?if($item->race===''):?>
                                    <?=form_dropdown('race-select', race_options(), $item->race);?>
                                        
                                <?else:?>
                                    <?if(!in_array($item->race,race_options())):?>
                                        <?=form_dropdown('race-select', race_options(), 'Other');?>
                                            
                                    <?else:?>
                                        <?=form_dropdown('race-select', race_options(), $item->race);?>
                                            
                                    <?endif?>
                                <?endif?>
                              </li>
                              
                              <?if(!in_array($item->race,race_options())):?>
                                    <li class="race-hide">&nbsp;</li>
                                    <li class="race-hide">
                                      <label></label>
                                      <input value="<?=$item->race?>" name="race" id="race">
                                    </li>
                                <?else:?>
                                    <li class="hide race-hide">&nbsp;</li>
                                    <li class="hide race-hide">
                                      <label class="hide"></label>
                                      <input value="<?=$item->race?>" name="race" id="race" class="hide">
                                    </li>
                                <?endif?>
                            </li>
                            <li>
                                <label for="weight">Weight</label>
                                <input type="text" name="weight" value="<?=$item->weight?>" id="weight" placeholder="KG">
                            </li>
                            <li>
                                <label for="height">Height</label>
                                <input type="text" name="height" value="<?=$item->height?>" id="height" placeholder="CM">
                            </li>
                        </ul>
                    </li>

                    <li class="check-list_wrap">
                        <label>Do you have any language requests?</label>
                        <span class="err err_language"></span>
                        <ul class="check-list clearfix">
                            <?php foreach(languages_array() as $language):?>
                                <li>
                                    <label>
                                        <input type="checkbox" name="language[]" value="<?=$language?>" <?=in_array($language, $item->languages) ? 'checked' : ''?>/>
                                        <span></span> 
                                        <?=$language?>
                                    </label>
                                </li>
                            <?php endforeach;?>                           
                        </ul>
                    </li>

                    <?php if($who != 'me'):?>
                        <li class="medical">
                            <label>Diagnosis:</label>
                            <textarea name="diagnosis" id="diagnosis" cols="30" rows="10"><?=$item->diagnosis?></textarea>
                        </li>
                    <?php endif;?>


                    <li class="medical">
                        <label>Medical Condition:</label>
                        <textarea name="medical_condition" cols="30" rows="10"><?=$item->medical_condition?></textarea>
                    </li>
                </ul>
                <div class="clearfix">
                    <input type="hidden" name="who" value="<?=$who?>"/>
                    <input type="hidden" name="id" value="<?=$item->id?>">
                    <button class="btn-main btn-next">Next</button>
                </div>
            <?=form_close()?>
        </div>
    </div>
</section>
<script type="text/javascript">

	$(document).ready(function() {

            function dropdownClickOther(name) {

                    $(  "." + name + " select" ).change(function() {
                            var selected = $( "." + name + " select option:selected" ).text();
                            var input = $('#' + name);
                            if (selected === 'Other') {
                                    input.val('');
                                    input.removeClass('hide');
                                    $('.race-hide').css('display','');
                                    $('.race-hide').removeClass('hide');
                                    $('.race-hide label').removeClass('hide');
                            }
                            else {
                                    input.addClass('hide');
                                    input.val(selected);
                                    $('.race-hide').css('display','none');
                                    $('.race-hide').addClass('hide');
                                    $('.race-hide label').addClass('hide');
                            }
                    });
            }

            var elementsKey = [
                    {
                            func: dropdownClickOther('race')
                    }

            ];

            elementsKey.forEach(function(item) {
                    item.func;
            });

	});
</script>
