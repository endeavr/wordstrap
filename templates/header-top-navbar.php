<header id="banner" class="navbar navbar-fixed-top<?php $navbarstyle = of_get_option('ws_navbarstyle'); if ( $navbarstyle == 'inverse' ) { echo ' navbar-inverse'; } ?>" role="banner">
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
        	$ws_brand_logo_mark = of_get_option('ws_brand_logo_mark');
        	$ws_brand_logo_text = of_get_option('ws_brand_logo_text'); 
        	?>    
        		<?php if ( $ws_brand == 'one' ) : ?>
        			<span class="brand_font_text"><?php echo $ws_brand_font_text; ?></span>
        		<?php endif; ?>
        		<?php if ( $ws_brand == 'two' ) : ?>
        			<?php if ( $ws_brand_logo_mark != '' ) : ?>
        				<img class="brand_logo_mark" src="<?php echo $ws_brand_logo_mark; ?>" alt="<?php echo $ws_brand_font_text; ?>" /> 
        			<?php endif; ?>
        			<span class="brand_font_text"><?php echo $ws_brand_font_text; ?></span>
        		<?php endif; ?>
        		<?php if ( $ws_brand == 'three' ) : ?>
        			<?php if ( $ws_brand_logo_mark != '' ) : ?>
        				<img class="brand_logo_mark" src="<?php echo $ws_brand_logo_mark; ?>" alt="<?php echo $ws_brand_font_text; ?>" /> 
        			<?php endif; ?>
        			<?php if ( $ws_brand_logo_text != '' ) : ?>
        				<img class="brand_logo_text" src="<?php echo $ws_brand_logo_text; ?>" alt="<?php echo $ws_brand_font_text; ?>" />
        			<?php endif; ?>
        		<?php endif; ?>	
      </a>
      <nav id="nav-main" class="nav-collapse" role="navigation">
        <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav')); ?>
      </nav>
    </div>
  </div>
</header>