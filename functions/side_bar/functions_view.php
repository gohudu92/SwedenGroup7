<?php
function displayUsers($bdd, $nbUser = 5)
{
    $users = getUsers($bdd, $nbUser);
    foreach ($users as $user): ?>
        <div class="usersSideBar">
            <span class="label label-default"><?= $user; ?></span><i class="fa fa-paper-plane" aria-hidden="true"></i>
        </div>
        <hr/>
    <?php endforeach;
}