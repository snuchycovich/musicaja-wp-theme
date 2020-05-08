<?php get_header(); ?>

<div id="main">
  <div class="inner">
    <div id="breadcrum">
	<?php if (function_exists('mybread')) mybread();?>
    </div>
   <div id="content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="page" id="page-<?php the_ID();?>">
	    <h2><a href="<?php the_permalink( ); ?>"> <?php the_title() ; ?> </a></h2>
	    <?php the_content() ; ?>
      </article>
      <?php endwhile; else: ?>
	    <p> <?php _e('Sin entradadas', 'entorno'); ?> </p><!-- completar dominio-->
      <?php endif; ?>
  </div> <!-- #content -->
  <?php get_sidebar(); ?>
  <div class="clearfix">&nbsp;</div>
  </div><!--end inner-->
</div> <!-- #main -->

<?php get_footer(); ?>
</body>
</html>