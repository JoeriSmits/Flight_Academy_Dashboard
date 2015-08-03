<body class="animated fadeIn">
<section id="error-container">

    <div class="block-error">

        <div class="row">
            <div class="col-md-12 text-center">
                <header>
                    <h1 class="error"><i class="fa fa-lock"></i></h1>
                    <p class="text-center">Whoops, you are not logged in</p>
                </header>
            </div>
        </div>

        <p class="text-center">We are sorry but your session has expired. Please log in again to renew your session.</p>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button class="btn btn-primary btn-block btn-3d" onclick="window.location.replace('<?php echo site_url('/') ?>')">Login page</button>
            </div>
        </div>
    </div>

</section>