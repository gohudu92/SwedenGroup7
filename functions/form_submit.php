<?php
if (isset($_POST['registrationForm'])) {
    $resulRegistrationLogin = "";
    $resulRegistrationLogin = registerUser($_POST['registrationEmail'], $_POST['registrationUsername'], $_POST['registrationPassword'], $_POST['registrationConfirm'], $bdd);
    if ($resulRegistrationLogin == "") {
        loginUser($_POST['registrationEmail'], $_POST['registrationUsername'], $_POST['registrationPassword'], $bdd);
    }
}

if (isset($_POST['loginUser'])) {
    $resulRegistrationLogin = "";
    $resulRegistrationLogin = loginUser($_POST['emailUsername'], $_POST['emailUsername'], $_POST['password'], $bdd);
}

if (isset($_POST['formUploadPicture'])) {
    $target_dir = "view/img/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $errorFormPicture = "";
        $uploadOk = 1;
    } else {
        $errorFormPicture = "File is not an image.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errorFormPicture .= "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $errorFormPicture .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errorFormPicture .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $errorFormPicture .= "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            rename($target_file, $target_dir . getId() . "." . $imageFileType);
            $req = $bdd->prepare("UPDATE `user` SET `image`=:image WHERE `id`=:id");
            $id = getId();
            $image = getId() . "." . $imageFileType;
            $req->bindParam(":image", $image);
            $req->bindParam(":id", $id);
            $req->execute();
        } else {
            $errorFormPicture .= "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_POST['formUploadName'])) {
    if ($_POST['username'] == null OR $_POST['username'] == "" OR $_POST['username'] == " ") {
        $errorFormName = "Username must have at least one letter";
        return false;
    }
    $req = $bdd->prepare("UPDATE `user` SET `username`=:username WHERE `id`=:id");
    $id = getId();
    $username = $_POST['username'];
    $req->bindParam(":username", $username);
    $req->bindParam(":id", $id);
    $req->execute();
    $errorFormName = "Username is up to date";
}

if (isset($_POST['formUploadMail'])) {
    $req = $bdd->prepare("UPDATE `user` SET `mail`=:mail WHERE `id`=:id");
    $id = getId();
    $mail = $_POST['mail'];
    $req->bindParam(":mail", $mail);
    $req->bindParam(":id", $id);
    $req->execute();
    $errorFormMail = "Mail is up to date";
}

if (isset($_POST['changePassword'])) {
    $previousPassword = sha1($_POST['prePassword']);
    $newPassword = sha1($_POST['newPassword']);
    $confirmPassword = sha1($_POST['confirmNewPassword']);
    if ($newPassword != $confirmPassword) {
        $errorFormPassword = "Both new password don't match";
        return false;
    }
    $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
    $datas->execute(array(getId()));
    while ($data = $datas->fetch()) {
        if ($previousPassword == $data['password']) {
            $req = $bdd->prepare("UPDATE `user` SET `password`=:password WHERE `id`=:id");
            $id = getId();
            $req->bindParam(":password", $newPassword);
            $req->bindParam(":id", $id);
            $req->execute();
        } else {
            $errorFormPassword = "Wrong password";
            return false;
        }
    }
    $errorFormPassword = "Password is up to date";
}