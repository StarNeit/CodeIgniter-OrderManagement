<section class="container wizard-content payment-record">
    <div class="row">
        <div class="col-xs-12">
            <h3>Bank Account Details</h3>

            <form action="#" class="about-info bank-details">
                <fieldset>
                    <ul>
                        <li>
                            <label for="account-holder">Name of Account Holder</label>
                            <input type="text" name="account-holder" id="account-holder" placeholder="JANE DOE">
                        </li>
                        <li>
                            <label for="bank-info">Type of Bank</label>
                            <select name="bank-info" id="bank-info">
                                <option value="0" selected>DBS</option>
                                <option value="1" selected>DBS</option>
                            </select>
                        </li>
                        <li class="bank-account-number">
                            <label for="bank-account-number">Bank Account Number</label>
                            <input type="text" name="bank-account-number" id="bank-account-number" placeholder="00">
                            <span>-</span>
                            <input type="text" name="bank-account-number" placeholder="1234">
                            <span>-</span>
                            <input type="text" name="bank-account-number" placeholder="5">
                        </li>
                    </ul>
                </fieldset>
            </form>
            <div class="clearfix">
                <a href="#" class="btn btn-enter">Update</a>
            </div>

            <form action="#" class="about-info bank-details">
                <fieldset>
                    <h3>Credit Card Details</h3>
                    <label class="credit-card">
                        <input type="radio" name="gender" value="" checked><span></span> Credit Card
                    </label>
                    <ul>
                        <li>
                            <label for="full-name">Full Name</label>
                            <input type="text" name="full-name" id="full-name" placeholder="JANE DOE">
                        </li>
                        <li>
                            <label for="card-number">Card Number</label>
                            <input type="text" name="card-number" id="card-number" placeholder="5463 7123 1111 0000">
                        </li>
                        <li class="expiry-date">
                            <label>Expiry Date</label>
                            <select name="date" id="date">
                                <option value="0" selected>1</option>
                                <option value="1" selected>2</option>
                            </select>
                            <span>-</span>
                            <select name="month" id="month">
                                <option value="0" selected>1</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                            </select>
                            <span>-</span>
                            <select name="year" id="year">
                                <option value="0" selected>2020</option>
                                <option value="1">2021</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                            </select>
                        </li>
                        <li class="cvc">
                            <label for="cvc">CVC</label>
                            <input type="text" name="cvc" id="cvc" placeholder="123">
                        </li>
                    </ul>
                </fieldset>
            </form>
            <div class="clearfix">
                <a href="#" class="btn btn-enter">Update</a>
            </div>

            <h3>Pending Amount</h3>

            <span class="pending-amount">SGD 500.00</span><a href="#" id="popoverData" class="btn"
                                                             data-content="Popover with data-trigger" rel="popover"
                                                             data-placement="right" data-trigger="hover"><span class="fa fa-info"></span></a>

            <h3 class="transaction">Transaction</h3>

            <span>Services paid</span>
            <span>outstanding payment from homage</span>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Date</th>
                        <th>Care Recipient</th>
                        <th>CarePro</th>
                        <th class="text-center">Payment</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>2 April 2016</td>
                        <td>Siah Hong Siew</td>
                        <td class="table-user-name">Lim Ai Xian</td>
                        <td>SGD 100.00</td>
                        <td><span class="fa fa-file-text"></span></td>
                    </tr>
                    <tr>
                        <td>23 March 2016</td>
                        <td>Siah Hong Siew</td>
                        <td class="table-user-name">Nur Amelia</td>
                        <td>SGD 0.00</td>
                        <td><span class="fa fa-file-text"></span></td>
                    </tr>
                    <tr>
                        <td>21 February 2016</td>
                        <td>Siah Hong Siew</td>
                        <td class="table-user-name">Nur Amelia</td>
                        <td>SGD 100.00</td>
                        <td><span class="fa fa-file-text"></span></td>
                    </tr>
                    <tr>
                        <td>2 February 2016</td>
                        <td>Siah Hong Siew</td>
                        <td class="table-user-name">Paul Smith</td>
                        <td>SGD 100.00</td>
                        <td><span class="fa fa-file-text"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
