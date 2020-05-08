<?php get_header(); ?>

<div id="main">
  <div class="inner">
    <div id="breadcrum">
	<?php if (function_exists('mybread')) mybread();?>
  </div>
  <div id="content">
      <h2><?php _e("&#161;Lo sentimos!"); ?></h2>
    <div><?php _e("Error 404 - P&#225;gina no encontrada"); ?></div>
  </div> <!-- #content -->
  <?php get_sidebar(); ?>
  <div class="clearfix">&nbsp;</div>
  </div>
</div> <!-- #main -->


<?php get_footer(); ?>
</body>
</html>