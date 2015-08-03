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
                            <div class="progress-bar progress-bar-info" style="width: 20%">20%</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="title"><i class="fa fa-user"></i> Update profile</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="alert alert-danger hidden" id="errorAlert"></p>
                                <?php
                                $attributes = array('id' => 'frm_updateProfile', 'class' => 'form-horizontal', 'role' => 'form');
                                validation_errors();
                                echo form_open('registration/validateProfileData', $attributes) ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Callsign*</label>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo $userData['callsign'] ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">First Name*</label>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo $userData['firstName']; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Prefix</label>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo $userData['prefix']; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Last Name*</label>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo $userData['lastName']; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">E-mail*</label>

                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo $userData['eMail']; ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Day of Birth*</label>

                                    <div class="col-sm-6">
                                        <input name="dayOfBirth" type="date" class="form-control" required
                                               value="<?php if (isset($userData['dayOfBirth'])) {
                                                   echo $userData['dayOfBirth'];
                                               } ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">City</label>

                                    <div class="col-sm-6">
                                        <input name="city" type="text" class="form-control"
                                               placeholder="Enter your city (Optional)"
                                               value="<?php if (isset($userData['city'])) {
                                                   echo $userData['city'];
                                               } ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country*</label>

                                    <div class="col-sm-6">
                                        <select name="country" class="form-control" required>
                                            <?php
                                            foreach ($countries as $county) {
                                                if ($county['countryId'] == $userData['country']) {
                                                    $select = 'selected';
                                                } else {
                                                    $select = '';
                                                }
                                                echo "<option value='" . $county['countryId'] . "'" . $select . ">" . $county['countryName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Telephone number</label>

                                    <div class="col-sm-6">
                                        <input name="phoneNumber" type="text" class="form-control"
                                               placeholder="Enter your telephone number (Optional)"
                                               value="<?php if (!empty($userData['telephoneNr'])) {
                                                   echo $userData['telephoneNr'];
                                               } ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mobile number</label>

                                    <div class="col-sm-6">
                                        <input name="mobileNumber" type="text" class="form-control"
                                               placeholder="Enter your mobile number (Optional)"
                                               value="<?php if (!empty($userData['mobileNr'])) {
                                                   echo $userData['mobileNr'];
                                               } ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary">Next step <i class="fa fa-caret-right"></i></button>
                                    </div>
                                </div>
                                </form>
                                <p>* Required field</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>