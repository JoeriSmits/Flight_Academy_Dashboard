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
                            <div class="progress-bar progress-bar-info" style="width: 40%">40%</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="title"><i class="fa fa-image"></i> Upload an avatar (Optional)</h2>
                            </div>
                        </div>
                        <div class="row">
                            <p class="alert alert-danger hidden" id="errorAlert"></p>
                            <?php
                            $attributes = array('id' => 'frm_uploadAvatar', 'class' => 'form-horizontal', 'role' => 'form');
                            echo form_open('registration/validateAvatar', $attributes) ?>
                            <div class="image-editor">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <span class="btn btn-primary btn-file btn-block center-block">
                                                Browse an avatar (Max 1MB)<input name="avatarInput" type="file"
                                                                       class="cropit-image-input">
                                            </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- .cropit-image-preview-container is needed for background image to work -->
                                        <div class="cropit-image-preview-container">
                                            <div class="cropit-image-preview"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="slider-wrapper">
                                        <div class="col-sm-3 text-center">
                                            <i class="fa fa-image"></i>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="range"
                                                   class="cropit-image-zoom-input"
                                                   min="0"
                                                   max="1"
                                                   step="0.01"
                                                   value="0">
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <i class="fa fa-image fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Next Step <i
                                                class="fa fa-caret-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>