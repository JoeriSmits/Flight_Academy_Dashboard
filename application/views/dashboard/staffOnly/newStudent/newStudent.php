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
                    <div class="panel-body">
                        <p>Dear Trainers,</p>

                        <p>On this page you will find all new students that have already registered and payed. They have
                            to
                            be assigned to a trainer. If you think you still have room for another student <strong>please
                                assign
                                a student</strong>. New students are ordered on the date of registration and the most
                            long waiting
                            students are displayed at top.</p>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Callsign</th>
                                    <th>Firstname</th>
                                    <th>Prefix</th>
                                    <th>Lastname</th>
                                    <th>E-mail</th>
                                    <th>Day of Birth</th>
                                    <th>Date of registration</th>
                                    <th>Assign</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($newStudents as $key=>$newStudent) {
                                    $key = $key + 1;
                                    echo '<tr>';
                                    echo '<td>' . $key . '</td>';
                                    echo '<td>' . $newStudent['callsign'] . '</td>';
                                    echo '<td>' . $newStudent['firstName'] . '</td>';
                                    echo '<td>' . $newStudent['prefix'] . '</td>';
                                    echo '<td>' . $newStudent['lastName'] . '</td>';
                                    echo '<td>' . $newStudent['eMail'] . '</td>';
                                    echo '<td>' . $newStudent['dayOfBirth'] . '</td>';
                                    echo '<td>' . $newStudent['dateOfRegistration'] . '</td>';
                                    echo '<td><a href="' . site_url('newStudent/assignStudent/' . $newStudent['userId']) . '" class="btn btn-primary">More info</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>