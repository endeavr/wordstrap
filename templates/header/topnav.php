<div <?php ws_navbar_class(); ws_affix(); ?>>
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="<?php echo home_url(); ?>/">
        	<?php 
        	$ws_brand = of_get_option('ws_brand');
        	$ws_brand_font_text = of_get_option('ws_brand_font_text');
        	$ws_brand_mark = of_get_option('ws_brand_mark');
        	$ws_brand_logo = of_get_option('ws_brand_logo'); 
        	?>    
        		<?php if ( $ws_brand == 'one' ) : ?>
        			<span class="brand_font_text"><?php echo $ws_brand_font_text; ?></span>
        		<?php endif; ?>
        		<?php if ( $ws_brand == 'two' ) : ?>
        			<?php if ( $ws_brand_mark != '' ) : ?>
        				<img class="brand_mark" src="<?php echo $ws_brand_mark; ?>" alt="<?php echo $ws_brand_font_text; ?>" /> 
        			<?php endif; ?>
        			<span class="brand_font_text"><?php echo $ws_brand_font_text; ?></span>
        		<?php endif; ?>
        		<?php if ( $ws_brand == 'three' ) : ?>
        			<?php if ( $ws_brand_logo != '' ) : ?>
        				<img class="brand_logo" src="<?php echo $ws_brand_logo; ?>" alt="<?php echo $ws_brand_font_text; ?>" /> 
        			<?php endif; ?>
        		<?php endif; ?>	
      </a>
      <nav id="nav-main" class="nav-collapse" role="navigation">
        <?php
          if (has_nav_menu('primary_navigation')) {
            wp_nav_menu(array( 'theme_location' => 'primary_navigation', 'menu_class' => 'nav' ));
          }
        ?>
      </nav>
    </div>
  </div>
</div>