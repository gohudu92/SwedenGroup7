<?php
include_once($_SERVER['DOCUMENT_ROOT']."/functions/_functions.php");
$current_page=basename($_SERVER['PHP_SELF']);
$title="No title";
if($current_page=='index.php'){
	$title="Home";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Library -->
	<link rel="stylesheet" href="/view/library/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/view/library/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- Library -->
	<link rel="stylesheet" href="/view/css/style.css">
	
	<!-- Library -->
	<script src="/view/library/jquery/jquery-3.2.1.min.js"></script>
    <script src="/view/library/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<!-- Library -->
    <script src="/view/js/script.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/"><?= $nameWebsite; ?></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="<?php echo ($current_page=='index.php') ? 'active' : NULL ?>"><a href="/">Home</a></li>
            </ul>
			<?php if (!isset($_SESSION) OR (empty($_SESSION))): ?>
				<form class="navbar-form navbar-right" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" name="emailUsername" value="" placeholder="Email Or Username">                                        
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" name="password" value="" placeholder="Password">                                        
					</div>
					<button type="submit" name="loginUser" class="btn btn-primary">Login</button>
				</form>
				<div style="margin-top:8px;">
					<button style="float:right" data-toggle="modal" data-target="#registerModal" class="btn btn-danger">Register</button>
				</div>
			<?php else: ?>
				<ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>Connected</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?= $_SESSION['username']; ?></strong></p>
                                        <p class="text-left small"><?= $_SESSION['mail']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="/logout.php" class="btn btn-danger btn-block">Log out</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
			<?php endif; ?>
        </div>
    </nav>
<div id="registerModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<div class="row main col-xs-10 col-xs-offset-1">
					<div class="panel-heading">
					   <div class="panel-title text-center">
							<h1 class="title">Registration Form</h1>
							<hr />
						</div>
					</div> 
					<div class="main-login main-center">
						<form class="form-horizontal" method="post">
							<div class="form-group">
								<label for="email" class="cols-sm-2 control-label">Your Email</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
										<input type="text" class="form-control" name="registrationEmail" placeholder="Enter your Email" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="cols-sm-2 control-label">Username</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
										<input type="text" class="form-control" name="registrationUsername" placeholder="Enter your Username" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
										<input type="password" class="form-control" name="registrationPassword" placeholder="Enter your Password" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
										<input type="password" class="form-control" name="registrationConfirm" placeholder="Confirm your Password" required />
									</div>
								</div>
							</div>
							<div class="form-group ">
								<button name="registrationForm" type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php
if(isset($resulRegistrationLogin) AND $resulRegistrationLogin!="" AND is_string($resulRegistrationLogin)){
	echo"<br/><br/><br/>
	<div class='alert alert-danger'>
		<strong>".$resulRegistrationLogin."</strong>
	</div>
	";
}
?>
</header>