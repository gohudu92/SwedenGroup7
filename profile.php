<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container">
        <h1>Profile</h1>
        <div class="row">
            <div class="col-xs-10">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img src="/view/img/default.png" alt=""
                                             class="img-rounded img-responsive"/>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Your name</label>
                                                <div class="col-xs-11 noPadding">
                                                    <input value="<?= $_SESSION['username']; ?>" type="text"
                                                           class="form-control">
                                                </div>
                                                <div class="col-xs-1 noPadding">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </div>
                                            </h4>
                                        </div>
                                        <small><cite title="San Francisco, USA">Jönköping, Sweden <i
                                                    class="glyphicon glyphicon-map-marker">
                                                </i></cite></small>
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Your mail</label>
                                                <div class="col-xs-11 noPadding">
                                                    <input value="<?= $_SESSION['mail']; ?>" type="email"
                                                           class="form-control">
                                                </div>
                                                <div class="col-xs-1 noPadding">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </div>
                                            </h4>
                                        </div>
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Change your photo</label>
                                                <div class="col-xs-11 noPadding">
                                                    <input type="file">
                                                </div>
                                                <div class="col-xs-1 noPadding">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </div>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Previous password:</label>
                                            <input name="prePassword" type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>New password:</label>
                                            <input name="newPassword" type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm new password:</label>
                                            <input name="confirmNewPassword" type="password"
                                                   class="form-control">
                                        </div>
                                        <button class="btn btn-primary form-control">Change password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("view/footer.php");
?>