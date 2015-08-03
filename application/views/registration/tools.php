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
                            <div class="progress-bar progress-bar-info" style="width: 100%">100%</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="title"><i class="fa fa-wrench"></i> Tools we are using</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3><i class="fa fa-microphone"></i> Teamspeak 3</h3>

                                <p>
                                    We are using Teamspeak 3 during the training for communication between the student
                                    and the trainer. Teamspeak 3 is a program that let you communicate using your voice
                                    with other people. The program can best be compared with Skype.
                                </p>

                                <p>"With superior voice quality, TeamSpeak can easily
                                    and effectively facilitate communication between
                                    teachers and students, or even students and
                                    students. TeamSpeak allows teachers to provide
                                    instant feedback and assistance to their students
                                    or conduct online classes, and is perfect for foreign
                                    language learning and practice. TeamSpeak is also
                                    ideal for online tutoring, student operated study
                                    groups, or long distance education and learning." - Teamspeak 3 </p>

                                <p>As your first training will take place on the Teamspeak 3 server. You will need to
                                    install
                                    Teamspeak 3 prior to your first training at the Flight-Academy. If you have any
                                    questions regarding the installations of Teamspeak 3 feel free to look at their <a
                                        href="http://teamspeak.com" target="_blank">website</a> or contact your trainer.
                                </p>

                                <p><a href="http://www.teamspeak.com/?page=downloads" target="_blank"
                                      class="btn btn-primary">Download Teamspeak 3</a></p>

                                <h3><i class="fa fa-server"></i> FSD Server</h3>

                                <p>We are using a FSD server for flight tracking and monitoring. Trainers are able, by
                                    using this server, to
                                    watch you closely during your training. To make this possible all students should
                                    have installed FSInn. FSInn is a pilot client that sends your flight data to our
                                    server. As the installation of FSInn could sometimes be tricky we have created a
                                    step by step installation manual for FSInn.</p>

                                <p>If there are any problems during your installation please look at the trouble shoot
                                    section of the document. If the problem remains you can contact your trainer or
                                    contact the web master directly.</p>

                                <p><a href="<?php echo base_url('assets/documents/FsInn_Installation_v1.2.pdf'); ?>"
                                      target="_blank" class="btn btn-primary">Download the installation manual</a></p>
                                <p>&nbsp;</p>
                                <p>The document will also be accessible from the dashboard. If all of these tools were
                                    installed correctly you are ready to go to start your first training at the
                                    Flight-Academy!</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <?php
                        echo form_open('/registration/continueToDashboard') ?>
                        <button class="btn btn-primary" type="submit">Continue to the dashboard <i class="fa fa-caret-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>