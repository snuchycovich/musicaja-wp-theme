<?php get_header(); ?>
<div id="mainHome">
<div class="inner">
      <?php if (function_exists('rps_show')) echo rps_show(); ?>

<div id="content">
      <h2 class="subtitulo"> M&#225;s Noticias</h2> 
      <!--loop-->
      <?php query_posts($query_string . '&cat=4'.'&showposts=3'.'posts_per_page=3&offset=2');/*Excluir las últimas 5*/
      if ( have_posts() ) : while ( have_posts() ) : the_post();?>
      <?php if( $post->ID == $do_not_duplicate ) continue;?>
      <?php if ( in_category('4') ) { ?>
           <div class="post-cat-three">
      <?php } else { ?>
           <div class="post">
      <?php } ?>
      
      <article class="home_post post" id="post-<?php the_ID();?>">
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
      </div> <!-- closes the first div box -->
      
      <?php endwhile; else: ?>
	    <p> <?php _e('Sin entradadas', 'musicajarocha'); ?> </p>
      <?php endif; ?>
      
      <a href="http://localhost/musicajarocha/?cat=4" class="todas">Todas las Noticias &raquo;</a>

</div> <!-- #content-->

<?php get_sidebar(); ?>
<div class="clearfix">&nbsp;</div>
</div> <!-- end inner-->

</div> <!-- #mainHome -->

<?php get_footer(); ?>
</body>
</html>