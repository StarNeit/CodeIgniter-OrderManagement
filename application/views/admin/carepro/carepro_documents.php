<div class="page-content">

    <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>

    <div class="page-body">
        <!-- Tabs -->
        
        <div class="tabbable">

            <? $this->load->view("admin/carepro/carepro_tabs")?>

            <div class="tab-content radius-bordered">
                <div class="tab-pane in active">

                    <?=form_open(admin_url("carepro/save_documents"), 'id="document_form" class="form-horizontal" method="post" enctype="multipart/form-data"')?>
             
                        <div id="message"><?=show_message()?></div>

                        
                        <div class="form-title">
                            CPR/BCLS Certification/Card
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="file" name="documents[]">
                                        <?if(isset($user->doc['CRP'])):?>
                                        <br/><a href="<?=$user->doc['CRP']->document_url?>" target="_blank">Download</a>
                                        <?endif?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label no-padding-right">Valid Till</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input class="form-control date-picker standar_date" id="id-date-picker-1" type="text" name="dob" value="<?=isset($user->doc['CRP']) ? hdate($user->doc['CRP']->valid_till):''?>" data-date-format="dd-mm-yyyy">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="form-title">
                            TB Screening Report
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                    <input type="file" name="documents[]">
                                    <?if(isset($user->doc['TB'])):?>
                                        <br/><a href="<?=$user->doc['TB']->document_url?>" target="_blank">Download</a>
                                        <?endif?>
                                </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label no-padding-right">Completion On</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input class="form-control date-picker date" id="id-date-picker-2" type="text" name="dob" value="<?=isset($user->doc['TB']) ? hdate($user->doc['TB']->completion_on):''?>" data-date-format="dd/mm/yyyy">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar date"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <div class="form-title">
                            Caregiver Certificate
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input type="file" name="documents[]">
                                        <?if(isset($user->doc['Certificate'])):?>
                                        <br/><a href="<?=$user->doc['Certificate']->document_url?>" target="_blank">Download</a>
                                        <?endif?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label no-padding-right">Completion On</label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input class="form-control date-picker date" id="id-date-picker-3" type="text" name="dob" value="<?=isset($user->doc['Certificate']) ? hdate($user->doc['Certificate']->completion_on):''?>" data-date-format="dd-mm-yyyy">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        
                        <div class="form-title">
                            IC
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                    <input type="file" name="documents[]">
                                    <?if(isset($user->doc['IC'])):?>
                                        <br/><a href="<?=$user->doc['IC']->document_url?>" target="_blank">Download</a>
                                        <?endif?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                            
                        <div class="form-title">
                            Other Document
                        </div>
                        
                        <?if(isset($user->doc['Others'])):?>
                        <?foreach($user->doc['Others'] as $key=>$value):?>
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="other_doc">
                                            <input type="file" name="documents[]">
                                        <br/><a href="<?=$value->document_url?>" target="_blank">Download</a>
                                        </div>
                                    </div>
<!--                                    <div class="col-lg-3">
                                        <div class="form-group btn-add-minus">
                                            <a class="btn btn-blue btn-xs icon-only white" onclick="plus();"><i class="fa fa-plus"></i></a>
                                            <a class="btn btn-xs icon-only" onclick="minus();"><i class="fa fa-minus"></i></a>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <br/>
                        <?endforeach?>
                        <?else:?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="other_doc">
                                            <input type="file" name="documents[]">
                                        </div>
                                    </div>
<!--                                    <div class="col-lg-3">
                                        <div class="form-group btn-add-minus">
                                            <a class="btn btn-blue btn-xs icon-only white" onclick="plus();"><i class="fa fa-plus" id="plus"></i></a>
                                            <a class="btn btn-xs icon-only" onclick="minus();"><i class="fa fa-minus" id="minus"></i></a>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        <span id="appendrow">
                        </span>
                            <br/>
                        <?endif?>
                        <script>
                            function plus() {
                                $('#appendrow').append('<span id="appendedrow"><div class="row">'+
                                '<div class="col-lg-12">'+
                                    '<div class="col-lg-3">'+
                                        '<div class="form-group">'+
                                        '<input type="file" name="documents[]">'+
                                    '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '</span>');
                            }

                            function minus() {
                                var rowappended = $('#appendrow').find('#appendedrow').length;

                                if(rowappended>0)
                                    $('#appendedrow:last-child').remove();
                                else
                                    alert('Cannot remove last record');
                            }
                        </script>
                        <div class="form-title">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 pull-right">
                                <input type="hidden" name="user_id" value="<?=$user->user_id?>" />
                                <input class="btn btn-palegreen pull-right disabled" type="submit" value="Save" />
                            </div>
                        </div>
                    <?=form_close()?>                   
                </div>

            </div>


        </div>
    </div>
    <script>
        $( '#document_form' ).submit( function(e){
            $.ajax( {
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: new FormData( this ),
                success: function(data){ShowResults(data, $(this))},
                error: function(data, status){          
        ShowAjaxError(data)},
                processData: false,
                contentType: false,
                dataType: "json"
              } );
            return false;
        })
</script>