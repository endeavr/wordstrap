<?php tha_sidebars_before(); ?>
<aside id="sidebar" <?php ws_sidebar_class(); ?> role="complementary">
	<?php tha_sidebar_top(); ?>
     	<?php dynamic_sidebar('sidebar-primary'); ?>
     <?php tha_sidebar_bottom(); ?>
</aside>
<?php tha_sidebars_after(); ?>