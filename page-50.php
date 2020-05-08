<?php get_header(); ?>
<div id="mainHome">
<div class="inner">
  <?php if (function_exists('rps_show')) echo rps_show(); ?>
<div id="content">
	<?php while (have_posts()) : the_post(); ?> <!-- principio del loop -->
		<div id="primary">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="portada_layout_contenedor">
		<?php the_title() ; ?>
		</article>
		<?php endwhile; else: ?>
		<p> <?php _e('Sin entradadas', 'mmfilesi-bones'); ?> </p>
		<?php endif; ?>
		
		
		
		
		
		<!--<article class="layout_contenedor">
			<?php if ( wp_is_mobile() ) {
				if ( has_post_thumbnail() ) {
				the_post_thumbnail('medium', array('class' => 'imagenes_elasticas' ));
				} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/sin_imagenes.jpg" class="imagenes_elasticas"/>
				<?php }
			} else {
				if ( has_post_thumbnail() ) {
				the_post_thumbnail('full', array('class' => 'imagenes_elasticas' ));
				} else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/sin_imagenes.jpg" class="imagenes_elasticas" />
				<?php }
			} ?>
			<div class="layout_titular">
				<h3><a href="<?php the_permalink( ); ?>"> <?php the_title() ; ?> </a></h3>
			</div>
			<div class="layout_sumario"><?php the_excerpt() ; ?></div>
			<aside class="layout_metadatos">
				<p><?php _e('Clasificado en: ','mmfilesi-bones'); ?>
				<?php the_category(', '); ?></p>
				<p><?php the_tags(); ?></p>
				<?php _e('Escrito el: ','mmfilesi-bones'); ?>
				<?php the_time('j/m/Y'); ?></p>
			</aside>
		</article>
	<?php endwhile; ?>--> <!-- final del loop -->
</div> <!-- #content-->

<?php get_sidebar(); ?>
<div style="clear: both;">&nbsp;</div>
</div> <!-- end inner-->

</div> <!-- #mainHome -->

<?php get_footer(); ?>
</body>
</html>