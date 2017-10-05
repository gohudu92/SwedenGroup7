<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container">
        <h1>Profile</h1>
        <div class="row">
            <div class="col-md-6">
                <!-- Nav tabs --><div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#showInf" aria-controls="home" role="tab" data-toggle="tab">My informations</a></li>
                        <li role="presentation"><a href="#updateInf" aria-controls="profile" role="tab" data-toggle="tab">Update Informations</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="showInf">
                            Show informations
                        </div>
                        <div role="tabpanel" class="tab-pane" id="updateInf">
                            show form tu update info
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("view/footer.php");
?>