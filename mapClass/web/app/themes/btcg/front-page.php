<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/home/hero') ?>

  <?php get_template_part('templates/home/class-search') ?>

  <section class="cta-news">
    <div class="row">

      <?php get_template_part('templates/home/signup-form') ?>

      <?php get_template_part('templates/home/recent-news') ?>

    </div> <!--/.row-->
  </section> <!--/.cta-news-->

<?php endwhile; ?>
