<?php
use YafrmCore\Classes\View;
/** @var $this View */
?>
<?php
$this->getPart('inc/header') ?>
<?= $this->content ?>
<?php $this->getPart('inc/footer') ?>
