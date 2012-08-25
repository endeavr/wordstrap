<?php tha_footer_before(); ?>
<footer id="content-info" class="container" role="contentinfo">
  <?php tha_footer_top(); ?>
  <?php dynamic_sidebar('sidebar-footer'); ?>
  <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  <?php tha_footer_bottom(); ?>
</footer>
<?php tha_footer_after(); ?>

<?php wp_footer(); ?>