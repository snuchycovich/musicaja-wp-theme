<?php /* Template Name: Popup-audio */	?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title><?php wp_title('|', true, 'right'); ?><?php echo get_bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sitio web dedicado a la difusión del son jarocho. Aquí encontrará una amplía variedad de contenidos multimedia para para disfrutar en línea." />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
  <link rel="icon" type="image/png" href="http://localhost/musicajarocha/wp-content/themes/musicajarocha/images/favicon.png" />
</head>
<div id="wrapperPopup">
<div id="header" class="banner" role="banner">
  <div class="inner">
    <div id="logo">
      <h1><a class="brand" href="<?php echo home_url(); ?>/"><span class="hidden"><?php bloginfo('name'); ?></span></a></h1>
    </div>
  </div>
</div>
<div id="main">
  <div class="inner">
    
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
  <div class="clearfix">&nbsp;</div>
  </div><!--end inner-->
</div> <!-- #main -->

<div id="footer" class="content-info" role="contentinfo">
  <div class="inner">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
   
  <div class="imagenJarochos">&nbsp;</div>
  </div>
</div>

</div><!-- end wrapper -->
<?php wp_footer(); ?>
</body>
</html>