<section class="main-content-wrapper" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="fa fa-user-plus"></i>Registration</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" style="width: 60%">60%</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="title"><i class="fa fa-money"></i> Payment</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-shopping-cart"></i> Use a coupon code
                                    </div>
                                    <div class="panel-body">
                                        <p class="alert alert-danger hidden" id="errorAlert"></p>

                                        <p>You can use a coupon code to receive a discount on our price. Coupon codes
                                            will be available on staff's request and are most often published on our
                                            public website. Only one coupon per transaction is approved.</p>
                                        <?php
                                        $attributes = array('id' => 'frm_Coupon', 'class' => 'form-inline', 'role' => 'form');
                                        echo form_open('/registration/validateCoupon', $attributes) ?>
                                        <div class="form-group">
                                            <input id="couponCode" type="text" class="form-control" name="code"
                                                   placeholder="Coupon code"/>
                                        </div>
                                        <button id="useCouponBtn" type="submit" class="btn btn-primary">Use</button>
                                        </form>
                                    </div>
                                    <div class="panel-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-solid-primary">
                                    <div class="panel-heading">
                                        <i class="fa fa-paypal"></i> PayPal (Recommended)
                                    </div>
                                    <div class="panel-body">
                                        <p>Payment through PayPal is automatically integrated in our system. If we have
                                            received your payment we will transfer you to the next step.</p>

                                        <h1 class="amount">&euro;16.50*</h1>
                                        <small>* Incl. VAT (This payment is for the first course)</small>
                                    </div>
                                    <div class="panel-footer">
                                        <?php
                                        $attributes = array('id' => 'frm_PayPal');
                                        echo form_open('/payment', $attributes) ?>
                                        <button id="payPalBtn" class="btn btn-paypal" type="submit">Continue to PayPal
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-solid-green">
                                    <div class="panel-heading">
                                        <i class="fa fa-university"></i> Bank transfer
                                    </div>
                                    <div class="panel-body">
                                        <p>If you are not able to pay using PayPal we have the option to pay via a bank
                                            transfer. This process has to be manually checked and can take up to 3
                                            business
                                            days. After submitting you will be contacted by one of
                                            our staff members on the e-mail that you have registered. He will continue
                                            the payment process with you by mail.</p>

                                        <h1 class="amount">&euro;16.50*</h1>
                                        <small>* Incl. VAT (This payment is for the first course)</small>
                                    </div>
                                    <div class="panel-footer">
                                        <?php
                                        $attributes = array('id' => 'frn_BankTransfer');
                                        echo form_open('/payment/requestBankTransfer', $attributes) ?>
                                        <?php
                                        if (isset($bankTransfer)) {
                                            echo "<button class='btn btn-bankTransfer disabled'><i class='fa fa-check'></i> Bank transfer requested
                                        </button>";
                                        } else {
                                            echo "<button id='bankTransferBtn' class='btn btn-bankTransfer' type='submit'>Request a bank transfer
                                        </button>";
                                        }
                                        ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>