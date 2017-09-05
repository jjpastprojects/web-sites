<div class="utility-nav">
  <div class="row">
    <div class="column">
      <a href="#" class="login-link">Client Login</a>
      <div class="utility-icons">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </div>
</div>

<header class="header" role="banner">
  <div class="row">
    <div class="column">
      <button class="menu-icon">
        <strong>Menu</strong><span>toggle menu</span>
      </button>
      <a class="logo" href="/">
        <img src="<?php the_field('logo', 'options'); ?>" alt="">
      </a>
      <nav class="main-navigation" role="navigation">
        <div class="nav-container">
          <h1>{Navigation tk}</h1>
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
          endif;
          ?>
        </div>
      </nav>
    </div> <!--/.column-->
  </div> <!--/.row-->
</header> <!--/.header-->
