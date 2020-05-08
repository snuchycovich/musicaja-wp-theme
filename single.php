<?php get_header(); ?>

<div id="main">
  <div class="inner">
    <div id="breadcrum">
	<?php if (function_exists('mybread')) mybread();?>
  </div>
  <div id="content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <h2><!--<a href="<?php the_permalink( ); ?>">--> <?php the_title() ; ?> <!--</a>--></h2>
	    <p class="postmetadata"><span class="fecha"><?php the_time('j F Y') ?></span> <?php the_category(' ') ?></p>
	    <div class="post_content">
	    <?php the_content() ; ?>
	    </div>
      </article>
      <?php endwhile; ?>
	    <!--<p class="prevNext">
	    <?php previous_post_link() ?> <?php next_post_link() ?>
	    </p>-->
      <?php else : ?>
	    <p> <?php _e('Sin entradadas', 'entorno'); ?> </p><!-- completar dominio-->
      <?php endif; ?>
  </div> <!-- #content -->
  <?php get_sidebar(); ?>
  <div class="clearfix">&nbsp;</div>
  </div>
</div> <!-- #main -->


<?php get_footer(); ?>
</body>
</html>

