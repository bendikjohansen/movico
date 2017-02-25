<?php ob_start(); ?>

<h1><?= $title ?></h1>
<h3>Uh oh! '<?= uri() ?>' could not be found on this site.</h3>

<?php $content = ob_get_clean();


require 'layouts/error.view.php';	
