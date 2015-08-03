<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="icon-users"></i>New students</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Detailed user information of <?php echo $user['firstName']; ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?php echo base_url('/assets/img/userAvatar/' . $user['userId'] . '.png'); ?>"
                                     alt="User avatar"/>
                            </div>
                            <div class="col-sm-2">
                                <ul class="list-unstyled">
                                    <li><strong>First name:</strong></li>
                                    <li><strong>Prefix:</strong></li>
                                    <li><strong>Last name:</strong></li>
                                    <li><strong>E-mail:</strong></li>
                                    <li><strong>Day of Birth:</strong></li>
                                    <li><strong>City:</strong></li>
                                    <li><strong>Country:</strong></li>
                                    <li><strong>Telephone number:</strong></li>
                                    <li><strong>Mobile number:</strong></li>
                                </ul>
                            </div>
                            <div class="col-sm-2">
                                <ul class="list-unstyled">
                                    <li><?php echo $user['firstName']; ?></li>
                                    <li><?php echo $user['prefix']; ?></li>
                                    <li><?php echo $user['lastName']; ?></li>
                                    <li><?php echo $user['eMail']; ?></li>
                                    <li><?php echo $user['dayOfBirth']; ?></li>
                                    <li><?php echo $user['city']; ?></li>
                                    <li><?php echo $user['country']['countryName']; ?> <img
                                            src="<?php echo base_url('assets/img/countryFlags/' . strtolower($user['country']['countryCode'])); ?>.png"
                                            alt="countryFlag"></li>
                                    <li><?php echo $user['telephoneNr']; ?></li>
                                    <li><?php echo $user['mobileNr']; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <p class="alert alert-danger hidden" id="errorAlert"></p>

                                    <?php
                                    if(empty($wrongTrainer)) {
                                        if ($alreadyAssigned) {
                                            $notAssigned = 'hidden';
                                            $assignedText = '';
                                        } else {
                                            $notAssigned = '';
                                            $assignedText = 'hidden';
                                        }
                                    } else {
                                        echo "<p class='alert alert-danger'>Sorry, but this student is already assigned</p>";
                                    }
                                    ?>
                                    <?php
                                    if(empty($wrongTrainer)) {
                                        ?>
                                        <div id="notAssigned" class="<?php echo $notAssigned; ?>">
                                            <p>If you would like to give <?php echo $user['firstName']; ?> training,
                                                please assign this student.</p>
                                            <?php
                                            $attributes = array('id' => 'frm_assignStudent');
                                            echo form_open('/newStudent/assignStudentToTrainer/' . $user['userId'], $attributes) ?>
                                            <button type="submit" id="assignStudent" class="btn btn-primary">Assign
                                                student
                                            </button>
                                            </form>
                                        </div>
                                        <div id="assignedText" class="<?php echo $assignedText; ?>">
                                            <p><strong>You have assigned <?php echo $user['firstName']; ?> to
                                                    you.</strong> This
                                                student has now
                                                been added to your students, and can be found under the 'My students'
                                                page.</p>

                                            <p>Please send the student an e-mail to arrange an interview to
                                                determine which course the student will follow. <strong>The student has
                                                    also
                                                    been
                                                    informed</strong> that <strong>you will contact</strong> the student
                                                by mail about this
                                                interview.</p>
                                            <a href="mailto:<?php echo $user['eMail']; ?>" class="btn btn-primary">Send
                                                e-mail</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>