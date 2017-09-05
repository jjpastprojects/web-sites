<?php
use Roots\Sage\Config;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

  <?php get_template_part('templates/wrapper/head'); ?>

  <body <?php body_class(); ?>>

    <?php get_template_part('templates/wrapper/header'); ?>

    <?php include Wrapper\template_path(); ?>

    <?php get_template_part('templates/wrapper/footer'); ?>

  </body>
</html>
