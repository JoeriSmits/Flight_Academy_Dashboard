<section class="main-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="fa fa-exclamation-triangle"></i>Notice to Airmen</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">Welcome on the notice to airmen page. Here you can retrieve notam
                        information for airports all around the world. Simply send the ICAO code and we will do the
                        rest.
                    </div>
                    <div class="panel-footer">
                        <?php
                        $attributes = array('id' => 'frm_getNOTAM', 'class' => 'form-horizontal', 'role' => 'form');
                        validation_errors();
                        echo form_open('notam/ValidateAirport', $attributes) ?>
                        <div class="form-group">
                            <label for="icao" class="col-sm-2 control-label">ICAO Code</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="icao"
                                       placeholder="Enter ICAO Code" required>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn">Get NOTAMs
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center"><img src="<?php echo base_url('assets/img/spinner.gif') ?>"
                                              class="spinner hidden"></div>
                <div class="alert alert-danger hidden" id="notamNotFound">
                    <h4>Oh snap, that's unfortunate!</h4>

                    <p>There are no NOTAMs currently available for this airport.</p>
                </div>
            </div>
        </div>
        <div id="notams"></div>
    </section>
</section>
</div>