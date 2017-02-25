<?php ob_start(); ?>

<h1><?= $title ?></h1>
<h3>Please try again later.</h3>

<?php $content = ob_get_clean();

require 'layouts/error.view.php';
