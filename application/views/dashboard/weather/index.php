<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="fa fa fa-cloud"></i>Weather forecast</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">Welcome on the weather forecast page. Here you can retrieve weather
                        information for airports all around the world. Simply send the ICAO code and we will do the
                        rest.
                    </div>
                    <div class="panel-footer">
                        <?php
                        $attributes = array('id' => 'frm_getWeather', 'class' => 'form-horizontal', 'role' => 'form');
                        validation_errors();
                        echo form_open('weather/validateAirport', $attributes) ?>
                            <div class="form-group">
                                <label for="icao" class="col-sm-2 control-label">ICAO Code</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="icao"
                                           placeholder="Enter ICAO Code" required>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" id="getWeather" class="btn btn-primary">Get weather
                                        information
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Meteorological Aerodrome Report (METAR)</div>
                    <div class="panel-body">
                        <div class="text-center"><img src="<?php echo base_url('assets/img/spinner.gif') ?>"
                                                      class="spinner hidden"></div>
                        <div id="METAR"></div>
                        <div class="alert alert-warning noAirport">
                            <h4>Oh snap!</h4>

                            <p>There is no airport chosen. Please send me an airport so I can show you METAR
                                information.</p>
                        </div>
                        <div class="alert alert-danger hidden" id="metarNotFound">
                            <h4>Oh snap, that's unfortunate!</h4>

                            <p>The weather information seems not available for this airport. You can use an airport that
                                is the closest to this airport.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Terminal Aerodrome Forecast (TAF)</div>
                    <div class="panel-body">
                        <div class="text-center"><img src="<?php echo base_url('assets/img/spinner.gif') ?>"
                                                      class="spinner hidden"></div>
                        <div id="TAF"></div>
                        <div class="alert alert-warning noAirport">
                            <h4>Oh snap!</h4>

                            <p>There is no airport chosen. Please send me an airport so I can show you TAF
                                information.</p>
                        </div>
                        <div class="alert alert-danger hidden" id="tafNotFound">
                            <h4>Oh snap, that's unfortunate!</h4>

                            <p>The weather information seems not available for this airport. You can use an airport that
                                is the closest to this airport.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Meteorological Aerodrome Decoded Report (METAR)</div>
                    <div class="panel-body">
                        <div class="text-center"><img src="<?php echo base_url('assets/img/spinner.gif') ?>"
                                                      class="spinner hidden"></div>
                        <div id="DECODED"></div>
                        <div class="alert alert-warning noAirport">
                            <h4>Oh snap!</h4>

                            <p>There is no airport chosen. Please send me an airport so I can show you decoded METAR
                                information.</p>
                        </div>
                        <div class="alert alert-danger hidden" id="decodedNotFound">
                            <h4>Oh snap, that's unfortunate!</h4>

                            <p>The weather information seems not available for this airport. You can use an airport that
                                is the closest to this airport.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Significat Weather Charts</div>
                    <div class="panel-body">
                        <select id="sigwx" class="form-control">
                            <option>Europe</option>
                            <option>Europe & Asia</option>
                            <option>Europe & Africa</option>
                            <option>Europe & Eastern Atlantic</option>
                            <option>Europe & Middle East</option>
                        </select>
                        <img data-toggle="modal" data-target="#sigWxModal" class="sigwxImg preview"
                             onerror="this.src=''; this.alt=''; document.getElementById('noSigWXFound').setAttribute('class', 'alert alert-danger margin-top-10');"
                             src="http://weather.noaa.gov/pub/fax/PGDE14.PNG" alt="Significat Weather Chart">

                        <!-- Modal -->
                        <div class="modal fade" id="sigWxModal" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Significat Weather Chart</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img class="sigwxImg" src="http://weather.noaa.gov/pub/fax/PGDE14.PNG"
                                             alt="Significat Weather Chart">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger margin-top-10 hidden" id="noSigWXFound">
                            <h4>Oh snap, that's unfortunate!</h4>

                            <p>This weather chart seems currently not available</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>
<!--main content end-->