<div class="col-lg-12" >
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default bootstrap-admin-no-table-panel">
                <div class="panel-heading">
                    <div class="text-muted bootstrap-admin-box-title">Login</div>
                </div>
                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                    <form class="form-horizontal" method="POST" action="<?= base_url('login/processLogin')?>">
                        <fieldset>
                            <legend>Login Form</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="focusedInput">email</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="email_login" type="text" name="email_login" placeholder="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="pass_login" type="password" name="pass_login" placeholder="password" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>