<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="fa fa-comments"></i>Teamspeak</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger hidden" id="teamspeakOffline">
                    <h4>Oh no, something went wrong!</h4>

                    <p>Our teamspeak 3 server is currently offline. The webmaster has already been notified about this
                        issue. In case you have a training please contact your trainer for further steps.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Teamspeak 3 server</div>
                    <div class="panel-body" id="teamspeakViewer">
                        <div class="text-center"><img src="<?php echo base_url('assets/img/spinner.gif') ?>"
                                                      class="spinner"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Instructions</div>
                    <div class="panel-body">
                        <p>During your membership you have access to our own Teamspeak 3 server. Teamspeak is a free
                            software program which enabled people to speak with one another over the internet. The use
                            of a headset is recommended, but a microphone and speakers may work as well.
                            Your trainer and you will meet every training in the lobby of our Teamspeak 3 server. As
                            soon as the training starts you will switch to one of the training channels.</p>
                        <?php
                            if(!empty($session['prefix'])) {
                                $nickname = $session['callsign'] . ' - ' . $session['firstName'] . ' ' . $session['prefix'] . ' ' . $session['lastName'][0] . '.';
                            } else {
                                $nickname = $session['callsign'] . ' - ' . $session['firstName'] . ' ' . $session['lastName'][0] . '.';
                            }
                        ?>
                        <p><strong>Nickname:</strong> <?php echo $nickname; ?></p>
                        <a href="http://www.teamspeak.com/?page=downloads" target="_blank">
                            <button class="btn btn-default btn-3d"><i class="fa fa-cloud-download"></i> Download
                                Teamspeak 3
                            </button>
                        </a>
                        <a href="ts3server://ts.faserver.nl/?nickname=<?php echo $nickname;?>&password=<?php echo TEAMSPEAK3PASS;?>">
                            <button class="btn btn-primary btn-3d"><i class="fa fa-plug"></i> Connect to our Teamspeak 3 server
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>
<script src="<?php echo base_url('assets/js/teamspeak.js') ?>"></script>
<script>
    loadTeamspeakData('<?php echo site_url();?>');
</script>