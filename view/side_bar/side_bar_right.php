<p class="h4">Category</p>

<ul>
    <?php
    $allCat = getCategories($bdd);
    foreach ($allCat as $cat) { ?>
        <li><a href="/?cat=<?= $cat["name"]; ?>"><?= $cat["name"]; ?></a></li>
    <?php } ?>
</ul>
