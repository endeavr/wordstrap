<div id="masthead" <?php ws_masthead_class(); ?>>
	<div class="row">
	<div class="span12">
		<div class="row">
			<div id="brand" class="span4">
			      <a href="<?php echo home_url(); ?>/">
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
			</div>
			<div id="leaderboard" class="span8">
				
			</div>
		</div>
	</div>	
	</div>	
</div>