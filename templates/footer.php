<?php tha_footer_before(); ?>
<footer id="sitefooter">
	<div id="superfooter" <?php ws_footer_class(); ?> role="complementary">
		<?php tha_footer_top(); ?>
		<div class="container">
			<div class="row">
			<div class="span12">
				<div class="row">
					<div id="sf-one" class="span4">
						<?php dynamic_sidebar('sidebar-superfooter-col1'); ?>
					</div>
					<div id="sf-two" class="span4">
						<?php dynamic_sidebar('sidebar-superfooter-col2'); ?>
					</div>
					<div id="sf-three" class="span4">
						<?php dynamic_sidebar('sidebar-superfooter-col3'); ?>
					</div>
				</div>
			</div>	
			</div>	
		</div>	  
	  	<?php tha_footer_bottom(); ?>	  
	</div>
	<div id="colophon" <?php ws_colophon_class(); ?> role="contentinfo">
		<div class="container">
			<div class="row">
			<div class="span12">
				<div class="row">
					<div id="copyright" class="span6">
						<p>&copy; <?php echo date('Y'); ?> <?php $ws_brand_font_text = of_get_option('ws_brand_font_text'); echo $ws_brand_font_text; ?></p>  
					</div>
					<div id ="credits" class="span6">
						<p>Powered by: <a href="http://wordstrap.com" title="WordStrap">WordStrap</a>, an <a href="http://endeavr.com" title="Endeavr">Endeavr</a> Project
					</div>	
				</div>
			</div>	
			</div>
		</div>
	</div>	
</footer>
<?php tha_footer_after(); ?>

<?php if (GOOGLE_ANALYTICS_ID) : ?>
<script>
  var _gaq=[['_setAccount','<?php echo GOOGLE_ANALYTICS_ID; ?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>

<script>
$('[data-spy="affix"]').each(function () {
  $(this).affix('refresh')
});
</script>

<?php wp_footer(); ?>
