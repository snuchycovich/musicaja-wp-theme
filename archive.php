<?php get_header(); ?> <!-- ouvrir header,php -->
  <div id="main">
  <div class="inner">
      <div id="breadcrum">
	<?php if (function_exists('mybread')) mybread();?>
      </div>
  <div id="content_archive"><!-- loop -->
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <div class="post_content">
	    <h2><a href="<?php the_permalink(); ?>" class="post_title" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	    <p class="postmetadata"><span class="fecha"><?php the_time('d/m/Y') ?></span> <?php the_category(' '); ?></p>
	    <?php the_excerpt(); ?>
	    </div>
	     <a href="<?php the_permalink(); ?>" class="post_img" title="<?php the_title(); ?>">
	     <?php
	    if ( has_post_thumbnail() ) {
		  the_post_thumbnail('thumbnail');
		  }
		  else {
			  echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
		  }
		  ?></a>
	    <a href="<?php the_permalink(); ?>" class="leer">Leer M&#225;s</a>
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
  <div class="clearfix">&nbsp;</div>
  </div>
</div> <!-- #main -->
  <?php get_footer(); ?><!-- ouvrir footer,php -->
</body>
</html>