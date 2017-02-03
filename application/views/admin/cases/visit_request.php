
        <!-- Page Content -->
        <div class="page-content">
            <!-- Page Breadcrumb -->
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                    </li>
                    <li><a href="cases_view.html">Cases</a></li>
                    <li class="active"><?=$title?></li>
                </ul>
            </div>
            <!-- /Page Breadcrumb -->
            <!-- Page Header -->
            <div class="page-header position-relative">
                <div class="header-title">
                    <h1>
                        <?=$title?>
                    </h1>
                </div>
            </div>
            <!-- /Page Header -->
            <!-- Page Body -->
            <div class="page-body">
                <!-- Tabs -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabbable">
                            <?php $this->load->view("admin/cases/cases_tabs");?>

                            <div class="tab-content radius-bordered">
                                <div class="tab-pane in active">
                                    
                                </div>
                            </div>
                            <!--/Tab Content Ends -->
                            <br/>
                            <div class="widget">
                                <div class="widget-header bg-palegreen">
                                    <i class="widget-icon fa fa-arrow-down"></i>
                                    <span class="widget-caption">Visit No.02042016</span>
                                    <div class="widget-buttons">
                                        <a href="#" data-toggle="collapse">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                    </div><!--Widget Buttons-->
                                </div><!--Widget Header-->
                                <div class="widget-body">

                                    <div class="form-title">
                                        Where
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="nameInput">Block Number:</label>
                                                <input type="text" class="form-control" name="firstName" value="<?=$case->locations[0]->block?>"
                                                data-bv-notempty="true"
                                                data-bv-notempty-message="This field is required and cannot be empty." />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="nameInput">Street:</label>
                                                <input type="text" class="form-control" name="lastName" value="<?=$case->locations[0]->street?>"
                                                data-bv-notempty="true"
                                                data-bv-notempty-message="This field is required and cannot be empty." />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                         <div class="form-group">
                                            <label for="nameInput">Unit Number:</label>
                                            <input type="text" class="form-control" name="firstName" value="<?=$case->locations[0]->unit?>"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameInput">Postal Code:</label>
                                            <input type="text" class="form-control" name="lastName" value="<?=$case->locations[0]->postal_code?>"
                                            data-bv-notempty="true"
                                            data-bv-notempty-message="This field is required and cannot be empty." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-title">
                                CarePro Preferences
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Do you require 24hr Care/Live-in care?</label><br/><br/>
                                            <div class="control-group request">
                                            <div class="radio-inline">
                                                <label>
                                                    <?=form_radio("full_care", 1, $case->full_care,'class="colored-success"')?>
                                                    <span class="text">Yes</span>
                                                </label>
                                                <label>
                                                    <?=form_radio("full_care", 1, !$case->full_care,'class="colored-success"')?>
                                                    <span class="text">No</span>
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="regidateInput">Preferred CarePro Gender:</label>
                                            <?=form_dropdown('gender', gender_options(), $case->gender_pref);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12 request">
                                        Do you have any language requests?<br/>
                                        <?php foreach(languages_array() as $language):?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-blue" name="language[]" value="<?=$language?>" <?=in_array($language, $recipient->languages) ? 'checked="checked"' : ''?>/>
                                                    <span class="text"><?=$language?></span> 
                                                    
                                                </label>
                                            </div>
                                            <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-title">
                                Type of Services
                            </div>
                            <div class="row">
                                <div class="col-lg-12 care-services">
                                    <div class="col-lg-12">
                                    <?php foreach($this->common->services_and_skills() as $service):?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-blue" name="services[]" value="<?=$service->service?>" <?=in_array($service->service, $services) ? 'checked="checked"' : ''?>/>
                                                    <span class="text"><?=$service->service?></span> 
                                                    
                                                </label>
                                            </div>
                                            <?php endforeach;?>
                                    </div>
                                </div>    
                            </div>
                            <br/>
                            <!-- Table Starts -->
                            <div class="row ">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="well with-header">
                                        <div class="header bg-blue">
                                            Details
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>
                                                            Type of Services
                                                        </th>
                                                        <th>
                                                            Type of care
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                <?php $key =1; foreach($skills as $service):?>
                                                <tr>
                                                        <td>
                                                           <?=$key?>
                                                           <?php $key++; ?>
                                                        </td>
                                                        <td>
                                                           <?=$service->service?>
                                                        </td>
                                                        <td>
                                                            <?php foreach($service->skills as $skill):?>
                                                                <?=$skill->skill?><br>
                                                                <?php endforeach;?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Table Ends -->
                            <div class="form-title">
                                Special Instructions
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <textarea rows="5" cols="5" class="form-control">1) <?=$case->special_instructions?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <!-- Matching CarePro -->
                            <div class="widget-tab">
                                <h6 class="row-title before-green">MATCHING CAREPRO(S)</h6>
                            </div>
                            <br/>
                            <div class="row carepro">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="databox databox-xlg databox-halved databox-shadowed databox-vertical no-margin-bottom">
                                        <div class="databox-top bg-white padding-10">
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <img src="assets/img/avatars/aixian.jpg" style="width:75px; height:75px;" class="image-circular bordered-3 bordered-palegreen">
                                            </div>
                                            <div class="col-lg-6 col-sm-8 col-xs-8 text-align-left padding-10">
                                                <span class="databox-header carbon no-margin">Lim Ai Xian</span>
                                                <span class="databox-text lightcarbon no-margin green"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 margin-top-20">
                                                <button class="btn btn-info btn-sm pull-right">Assign</button>
                                            </div>
                                        </div>
                                        <div class="bg-white no-padding">
                                            <div class="databox-row row-12">
                                                <div class="databox-row row-6 no-padding">
                                                    <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                        <span class="databox-text sonic-silver  no-margin">District</span>
                                                        <span class="databox-number lightcarbon no-margin">Punggol East</span>
                                                    </div>
                                                    <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                        <span class="databox-text sonic-silver no-margin">Rating</span>
                                                        <span class="databox-number lightcarbon no-margin">4.3 / 5</span>
                                                    </div>
                                                    <div class="databox-cell cell-4 no-padding text-align-center">
                                                        <span class="databox-text sonic-silver no-margin">Age</span>
                                                        <span class="databox-number lightcarbon no-margin">62</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="databox databox-xlg databox-halved databox-shadowed databox-vertical no-margin-bottom">
                                        <div class="databox-top bg-white padding-10">
                                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                                <img src="assets/img/avatars/amelia.jpg" style="width:75px; height:75px;" class="image-circular bordered-3 bordered-palegreen">
                                            </div>
                                            <div class="col-lg-6 col-sm-8 col-xs-8 text-align-left padding-10">
                                                <span class="databox-header carbon no-margin">Nur Amelia</span>
                                                <span class="databox-text lightcarbon no-margin green"> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 margin-top-20">
                                                <button class="btn btn-info btn-sm pull-right">Assign</button>
                                            </div>
                                        </div>
                                        <div class="bg-white no-padding">
                                            <div class="databox-row row-12">
                                                <div class="databox-row row-6 no-padding">
                                                    <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                        <span class="databox-text sonic-silver  no-margin">District</span>
                                                        <span class="databox-number lightcarbon no-margin">Punggol East</span>
                                                    </div>
                                                    <div class="databox-cell cell-4 no-padding text-align-center bordered-right bordered-platinum">
                                                        <span class="databox-text sonic-silver no-margin">Rating</span>
                                                        <span class="databox-number lightcarbon no-margin">4.3 / 5</span>
                                                    </div>
                                                    <div class="databox-cell cell-4 no-padding text-align-center">
                                                        <span class="databox-text sonic-silver no-margin">Age</span>
                                                        <span class="databox-number lightcarbon no-margin">62</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Matching CarePro -->
                        </div>

                        <div class="form-title">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 pull-right">
                                <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                            </div>
                        </div>

                    </div><!--Widget Body-->
                </div>
            </div>
        </div>

    </div>
    <br/><br/>
    <!--/tabs-->
</div>