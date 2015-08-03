<body class="off-canvas">
<div id="container">
    <header id="header">
        <!--logo start-->
        <div class="brand">
            <a href="index.html" class="logo"><span>Flight</span>Academy</a>
        </div>
        <!--logo end-->
        <div class="toggle-navigation toggle-left">
            <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right"
                    title="Toggle Navigation">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="user-nav">
            <ul>
                <li class="profile-photo">
                    <?php
                    /**
                     * Check if the user image exists. If so it will set the $url to the user's image.
                     * If not it will set the URL to the noUserFound.png image.
                     */
                    $url = base_url('assets/img/userAvatar/' . $session['id'] . '.png');
                    $handle = curl_init($url);
                    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

                    /* Get the HTML or whatever is linked in $url. */
                    $response = curl_exec($handle);

                    /* Check for 404 (file not found). */
                    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if($httpCode == 404) {
                        $url = base_url('/assets/img/userAvatar/noUserFound.png');
                    }

                    curl_close($handle);
                    ?>
                    <img src="<?php echo $url ?>" alt="" class="img-circle menu_profile_pic">
                </li>
                <li class="dropdown settings">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $session['callsign'] . ' - ' . $session['firstName'] . ' ' . $session['lastName']; ?> <i
                            class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeIn">
                        <li>
                            <a href="#"><i class="fa fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar"></i> Calendar</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge badge-danger"
                                                                                   id="user-inbox">5</span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('authentication/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="toggle-navigation toggle-right">
                        <a href="javascript:void(0)" class="btn btn-default" id="toggle-right">
                            <i class="fa fa-comment"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!--sidebar left start-->
    <nav class="sidebar sidebar-left">
        <h5 class="sidebar-header">Navigation</h5>
        <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="<?php echo site_url('dashboard') ?>" title="Dashboard">
                        <i class="icon-speedometer"></i> Dashboard
                    </a>
                </li>
                <li class="nav-dropdown">
                    <a href="#" title="Flight planning"><i class="fa fa fa-plane"></i> Flight planning</a>
                    <ul class="nav-sub">
                        <li>
                            <a href="<?php echo site_url('dashboard/chart') ?>" title="Charts">
                                <i class="fa fa fa-compass"></i> Navigation charts
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dashboard/weather') ?>" title="Weather">
                                <i class="fa fa fa-cloud"></i> Weather forecast
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dashboard/notam') ?>" title="Notam">
                                <i class="fa fa-exclamation-triangle"></i> NOTAM
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dashboard/calculations') ?>" title="flight calculations">
                                <i class="fa fa-calculator"></i> Flight calculations
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('dashboard/sendFlightplan') ?>" title="send flightplan">
                                <i class="fa fa-file-text-o"></i> Flightplan
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url('dashboard/teamspeak') ?>" title="Teamspeak">
                        <i class="fa fa-comments"></i> Teamspeak
                    </a>
                </li>
            <li>
                <hr/>
                <a href="<?php echo site_url('dashboard/newStudent') ?>" title="newStudents">
                    <?php
                    if($newStudentsCount > 0) {
                        echo '<i class="icon-users"></i> New students <span class="badge badge-danger animated bounceIn">' . $newStudentsCount . '</span>';
                    } else {
                        echo '<i class="icon-users"></i> New students <span class="badge badge-default">0</span>';
                    }
                    ?>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('dashboard/myStudents') ?>" title="myStudents"><i class="fa fa-graduation-cap"></i>My students</a>
            </li>
            <li id="copyRightMenu">
                <hr/>
                <small>&copy; Flight-Academy 2009 - <?php echo date("Y"); ?></small>
                <small>Dashboard created by <a href="http://joerismits.nl" target="_blank">JoeriSmits.nl</a></small>
                <small>Version <?php echo VERSION . ' - ' . LAST_UPDATE_DATE; ?></small>
            </li>
        </ul>
    </nav>
    <!--sidebar left end-->