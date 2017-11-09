<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container paddingBot30">
        <h1>Profile</h1>
        <div class="row">
            <div class="col-xs-10">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="well well-sm">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php
                                        if($_SESSION['image']!=null AND $_SESSION['image']!=""){ ?>
                                            <img src="/view/img/uploads/<?= $_SESSION['image']; ?>" alt=""
                                                 class="img-rounded img-responsive"/>
                                        <?php }else{ ?>
                                            <img src="/view/img/default.png" alt=""
                                                 class="img-rounded img-responsive"/>
                                        <?php } ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Your name</label>
                                                <?php
                                                if(isset($errorFormName)){ ?>
                                                    <div class="alert alert-success alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?= $errorFormName; ?></strong>
                                                    </div>
                                                <?php } ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="col-xs-11 noPadding">
                                                        <input name="username" value="<?= $_SESSION['username']; ?>" type="text"
                                                               class="form-control">
                                                    </div>
                                                    <div class="col-xs-1 noPadding">
                                                        <button style="border: hidden;background-color: transparent;" name="formUploadName" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </h4>
                                        </div>
                                        <small><cite title="San Francisco, USA">Jönköping, Sweden <i
                                                    class="glyphicon glyphicon-map-marker">
                                                </i></cite></small>
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Your mail</label>
                                                <?php
                                                if(isset($errorFormMail)){ ?>
                                                    <div class="alert alert-success alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?= $errorFormMail; ?></strong>
                                                    </div>
                                                <?php } ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="col-xs-11 noPadding">
                                                        <input name="mail" value="<?= $_SESSION['mail']; ?>" type="email"
                                                               class="form-control">
                                                    </div>
                                                    <div class="col-xs-1 noPadding">
                                                        <button style="border: hidden;background-color: transparent;" name="formUploadMail" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </h4>
                                        </div>
                                        <div class="col-xs-12 noPadding">
                                            <h4><label>Change your photo</label>
                                            <?php
                                            if(isset($errorFormPicture)){ ?>
                                                <div class="alert alert-success alert-dismissable">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong><?= $errorFormPicture; ?></strong>
                                                </div>
                                            <?php } ?>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="col-xs-11 noPadding">
                                                    <input name="fileToUpload" type="file"/>
                                                </div>
                                                <div class="col-xs-1 noPadding">
                                                    <button style="border: hidden;background-color: transparent;" name="formUploadPicture" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <?php
                                        if(isset($errorFormPassword)){ ?>
                                            <div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?= $errorFormPassword; ?></strong>
                                            </div>
                                        <?php } ?>
                                        <form method="post" enctype="multipart/form-data">
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
                                            <button name="changePassword" class="btn btn-primary form-control">Change password</button>
                                        </form>
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