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
                <li class="dropdown settings">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $session['callsign'] . ' - ' . $session['firstName'] . ' ' . $session['lastName']; ?> <i
                            class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeIn">
                        <li>
                            <a href="authentication/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <!--sidebar left start-->
    <nav class="sidebar sidebar-left">
        <h5 class="sidebar-header">Navigation</h5>
        <ul class="nav nav-pills nav-stacked">
            <li class="active">
                <a href="javascript:void(0)" title="Registration">
                    <i class="fa fa-user-plus"></i> Registration
                </a>
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