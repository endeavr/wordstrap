<?php while (have_posts()) : the_post(); ?>
  <?php tha_entry_before(); ?>
  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php tha_entry_top(); ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php roots_entry_meta(); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
    </footer>
    <?php tha_entry_bottom(); ?>
    <?php tha_comments_before(); ?>
    <?php comments_template('/templates/comments.php'); ?>
    <?php tha_comments_after(); ?>
  </article>
  <?php tha_entry_after(); ?>
<?php endwhile; ?>