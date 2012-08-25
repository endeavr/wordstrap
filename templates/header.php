<header id="banner" role="banner">
  <?php tha_header_top(); ?>
  <div class="container">
    <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    <nav id="nav-main" role="navigation">
      <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-pills')); ?>
    </nav>
  </div>
  <?php tha_header_bottom(); ?>
</header>