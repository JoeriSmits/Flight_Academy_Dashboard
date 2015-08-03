<!--main content start-->
<section class="main-content-wrapper">
    <section id="main-content">
        <!--tiles start-->
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-tile detail tile-red">
                    <div class="content">
                        <h1 class="text-left">3
                            <small>Trainers online</small>
                        </h1>
                        <div class="toggle-navigation toggle-right">
                            <a href="javascript:void(0)" id="toggle-right-fromTile">
                                <p>Ask your questions or message them <i class="fa fa-angle-right"></i></p>
                            </a>
                        </div>
                    </div>
                    <div class="icon"><i class="fa fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-tile detail tile-green">
                    <div class="content">
                        <h1 class="text-left"><?php echo $teamspeakCount; ?>
                            <small>Teamspeak user(s) online</small>
                        </h1>
                        <p><a href="dashboard/teamspeak">Connect to our Teamspeak 3 server <i
                                    class="fa fa-angle-right"></i></a></p>
                    </div>
                    <div class="icon"><i class="fa fa-comments"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-tile detail tile-blue">
                    <div class="content">
                        <h1 class="text-left">Weather forecast</h1>

                        <p><a href="<?php echo site_url('dashboard/weather') ?>">Checkout the latest weather reports <i
                                    class="fa fa-angle-right"></i></a></p>
                    </div>
                    <div class="icon"><i class="fa fa fa-cloud"></i>
                    </div>
                </div>
            </div>
        </div>
        <!--tiles end-->
        <!-- to do start -->
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-check-square-o"></i> To do list</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $attributes = array('id' => 'frm_toDo');
                                validation_errors();
                                echo form_open('dashboard/validateToDo', $attributes) ?>
                                <div class="form-group">
                                    <input id="new-todo" type="text" name="message" class="form-control"
                                           placeholder="What needs to be done, <?php echo $session['firstName']; ?>?"
                                           required maxlength="200">
                                    <section id="main">
                                        <ul id="todo-list">
                                            <?php
                                            if (!empty($toDo)) {
                                                foreach ($toDo as $toDoItem) {
                                                    echo '<li>';
                                                    echo '<div class="view">';
                                                    echo '<div class="row">';
                                                    if ($toDoItem['finished']) {
                                                        $styles = "style='text-decoration: line-through' data='done'";
                                                        $checked = "checked";
                                                    } else {
                                                        $styles = "";
                                                        $checked = "";
                                                    }
                                                    echo '<div class="col-xs-1">';
                                                    echo '<input class="toggle" type="checkbox"' . $checked . '>';
                                                    echo '</div>';
                                                    echo '<div class="col-xs-10">';
                                                    echo "<label id='item'" . $styles . ">" . $toDoItem['message'] . "</label>";
                                                    echo '</div>';
                                                    echo '<div class="col-xs-1">';
                                                    echo "<a class='destroy'></a>";
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo "</div>";
                                                    echo "</li>";
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </section>
                                </div>
                                <div class="form-group">
                                    <button id="todo-enter" class="btn btn-primary pull-right">Submit</button>
                                    <div id="todo-count"></div>
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-calendar"></i> Training calender (Timezone: UTC)
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-graduation-cap"></i> Training's items</h3>
                            </div>
                            <div class="panel-body">
                                <p class="alert alert-danger"><strong>Unfortunately</strong>, you have not been assigned
                                    to a course. Please wait till your trainer has finished an interview with you. He
                                    will contact you by mail about this interview.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- to do end -->
    </section>
</section>
</div>
<!--main content end-->