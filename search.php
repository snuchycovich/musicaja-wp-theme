<?php get_header(); ?> <!-- ouvrir header,php -->
  <div id="main">
  <div class="inner">
      <div id="breadcrum">
	<?php if (function_exists('mybread')) mybread();?>
      </div>
  <div id="content"><!-- loop -->
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
      <article class="post" id="post-<?php the_ID();?>">
	    <div class="post_content">
	    <h2><a href="<?php the_permalink(); ?>" class="post_title" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	    <p class="postmetadata"><span class="fecha"><?php the_time('d/m/Y') ?></span> <?php the_category(''); ?></p>
	    <?php the_excerpt(); ?>
	    </div>
	    <div class="clearfix">&nbsp;</div>
      </article>
	<?php endwhile; ?>
	<?php endif; ?>
  
      <?php // paginación
      global $wp_query;
      
      $big = 999999999; // need an unlikely integer
      
      echo paginate_links( array(
	      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	      'format' => '?paged=%#%',
	      'current' => max( 1, get_query_var('paged') ),
	      'total' => $wp_query->max_num_pages
      ) );
      ?>
  </div> <!-- #content -->
  <?php get_sidebar(); ?>
  </div>
</div> <!-- #main -->
  <?php get_footer(); ?><!-- ouvrir footer,php -->
</body>
</html>