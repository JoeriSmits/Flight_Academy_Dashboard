<section class="main-content-wrapper">
    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1"><i class="fa fa-file-text-o"></i>Flightplan</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center"><h2>ICAO International Flight Plan</h2></div>
                        <form>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">7 Aircraft Identification</label>
                                        <input type="text" class="form-control"
                                               value="<?php echo $session['callsign']; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-offset-2 col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">8 Flight Rules</label>
                                        <select class="form-control">
                                            <option>I</option>
                                            <option>V</option>
                                            <option>Y</option>
                                            <option>Z</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-xs-offset-2">
                                    <div class="form-group">
                                        <label class="text-uppercase">Type of flight</label>
                                        <select class="form-control">
                                            <option>S</option>
                                            <option>N</option>
                                            <option>G</option>
                                            <option>M</option>
                                            <option>X</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label class="text-uppercase">9 Number</label>
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">Type of Aircraft</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">Wake turbulence cat.</label>
                                        <select class="form-control">
                                            <option>L</option>
                                            <option>M</option>
                                            <option>H</option>
                                            <option>J</option>
                                            <option>S</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">10 Equipment.</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="form-group">
                                        <label>Trans.</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">13 Departure aerodrome.</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label class="text-uppercase">Departure time</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">15 Cruising speed</label>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <select>
                                                    <option>N</option>
                                                    <option>M</option>
                                                    <option>K</option>
                                                </select>
                                            </span>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">Level</label>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <select>
                                                    <option>F</option>
                                                    <option>A</option>
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>VFR</option>
                                                </select>
                                            </span>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">Route</label>
                                        <textarea class="form-control" rows="4" style="resize: vertical;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="text-uppercase">16 Destination aerodrome</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label class="text-uppercase">Total EET</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">altn aerodrome</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">2nd altn aerodrome</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="text-uppercase">18 Other information</label>
                                        <textarea class="form-control" rows="3" style="resize: vertical;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr/>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">19 Endurance</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="text-uppercase">Persons on board</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="text-uppercase">Pilot in command</label>
                                        <input type="text" class="form-control"
                                               value="<?php echo $session['firstName'] . ' ' . $session['prefix'] . ' ' . $session['lastName']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary">Send flight plan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center"><h2>Submitted flight plans</h2></div>
                        <p class="alert alert-danger"><strong>No flight plans</strong>, we have not received any submitted flight plans from you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</div>