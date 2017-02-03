<div class="page-content">
 <? $this->load->view("admin/carepro/carepro_breadcrumbs");?>
 
 <!-- Page Body -->
 <div class="page-body">

    <div class="tabbable">
     <? $this->load->view("admin/carepro/carepro_tabs")?>

     <div class="tab-content radius-bordered">
        <div class="tab-pane in active">
            <!--Registration Form Starts-->



            <?=form_open(admin_url('carepro/save_payment'), 'class="form-horizontal" onsubmit="return SendForm(this)"')?>
                <div class="form-title">
                    Payment Method
                </div>
                <div id="message"><?=show_message()?></div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="control-group">
                                <div class="radio-inline">
                                    <label>
                                        <input name="form-field-radio" type="radio" class="colored-success" checked="checked">
                                        <span class="text"> Credit Card</span>
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input name="form-field-radio" type="radio" class="colored-success">
                                        <span class="text"> Offline Payment</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nameInput">Full Name: </label>
                                <input type="text" class="form-control" name="fullname" value="" placeholder="Jane Doe"
                                data-bv-notempty="true"
                                data-bv-notempty-message="This field is required and cannot be empty." />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="cardInput">Card Number: </label>
                                <input type="text" class="form-control" name="cardno" value="" placeholder="5463 7123 1111 0000"
                                data-bv-notempty="true"
                                data-bv-notempty-message="This field is required and cannot be empty." />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="cvcInput">CVC: </label>
                                <input type="text" class="form-control" name="cvc" value="" placeholder="123"
                                data-bv-notempty="true"
                                data-bv-notempty-message="This field is required and cannot be empty." />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="registrationInput">Expiry Date M/Y</label><br/>
                            <div class="btn-group"> <!-- group container for buttons merging -->

                                <div class="btn-group">
                                   <?=form_dropdown('expiry_month', month_options(), '')?>
                                </div>
                                <div class="btn-group">
                                    <?=form_dropdown('expiry_year', expiry_year_options(), '')?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-title"></div>
                <div class="form-group">
                    <div class="col-lg-6 pull-right">
                        <input type="hidden" name="user_id" value="<?=$user->user_id?>"></input>
                        <input class="btn btn-palegreen pull-right" type="submit" value="Save" />
                    </div>
                </div>
           <?=form_close()?>


            <div class="form-title">
                Oustanding Payment
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="payment databox databox-halved databox-lg radius-bordered databox-shadowed">
                            <div class="databox-left bg-pink">
                                <div class="databox-text white">UNPAID BALANCE</div>
                                <span class="databox-title white">SGD 500.00</span>
                            </div>
                            <div class="databox-right bg-white">
                                <a href="javascript:void(0);" class="btn btn-yellow">Send Reminder</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-title">
                Transaction
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bordered-palegreen">
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Care Recipient
                            </th>
                            <th>
                                Visit No.
                            </th>
                            <th>
                                Payment
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                2-Apr-16
                            </td>
                            <td>
                                Siah Hong Siew
                            </td>
                            <td>
                                02042016
                            </td>
                            <td>
                                SGD 100.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                23-Mar-16
                            </td>
                            <td>
                                Siah Hong Siew
                            </td>
                            <td>
                                02042016
                            </td>
                            <td>
                                SGD 10.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                21-Feb-16
                            </td>
                            <td>
                                Desmond Tan
                            </td>
                            <td>
                                02042016
                            </td>
                            <td>
                                SGD 100.00
                            </td>
                        </tr>
                        <tr>
                            <td>
                                2-Feb-16
                            </td>
                            <td>
                                Siah Hong Siew
                            </td>
                            <td>
                                02042016
                            </td>
                            <td>
                                SGD 45.00
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>




        </div>
    </div>
</div>

<br/><br/>
<!--/tabs-->
</div>