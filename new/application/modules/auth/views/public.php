    
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <div class="well pts prs pls">
                        <h3 class="mtn mb">Login</h3>
                        <form role="form" method="post" action="<?=site_url('auth/login_attempt')?>">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" name="username" value="" autofocus>
                            </div>
                            <div class="form-group mb">
                                <label for="pwd" class="control-label">Password</label>
                                <input type="password" class="form-control" name="pwd" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Login</button>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
