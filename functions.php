<?php

/* IMAGENES ==============================================================*/
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails', array( 'post' ) );
}

/* Definir nuevos tamaños de imágenes */  
if ( function_exists( 'add_image_size' ) ) {
    add_image_size('miniatura', 200, 200, true);
}  


function hmuda_image_sizes($sizes) {  
    $addsizes = array(  
        "miniatura" => __( "Versión pequeña para los archivos"),  
    );  
    $newsizes = array_merge($sizes, $addsizes);  
    return $newsizes;  
}

add_filter('image_size_names_choose', 'hmuda_image_sizes');


/* LOGO LOGIN =================================================================*/

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/site-login-logo.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* EXCERPT ====================================================================*/
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* WIDGET =====================================================================*/
if (function_exists('register_sidebar'))
    register_sidebar(array('id' => 'sidebar-1'));

/* CATEGORY EXCLUDE =========================================================*/
function exclude_post_categories($excl='', $spacer=' '){
    $categories = get_the_category($post->ID);
    if(!empty($categories)) {
        $exclude=$excl;
        $exclude = explode(",", $exclude);
        $count = count(get_the_category()) - count($exclude);
        foreach ($categories as $cat) {
            $html = '';
            if(!in_array($cat->cat_ID, $exclude)) {
                $html .= '<a href="' . get_category_link($cat->cat_ID) . '" ';
                $html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';
                if($count>1){
                    $html .= $spacer;
                }
            $count--;

            echo $html;
            }
        }
    }
}

/* BREADCRUMB=======================================================================*/

// Gat parent categories
function myget_category_parents($id, $link = false,$separator = '/',$nicename = false,$visited = array())
{
    $string = '';
    $parent = &get_category($id);

    if (is_wp_error($parent))return $parent;

    if ($nicename) {
        $name = $parent->name;
    } else {
        $name = $parent->cat_name;
    }

    if ($parent->parent && ($parent->parent != $parent->term_id ) && !in_array($parent->parent, $visited)) {
        $visited[] = $parent->parent;
        $string .= myget_category_parents( $parent->parent, $link, $separator, $nicename, $visited );
    }

    if ($link) {
        $string .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $parent->term_id ) . '" title="Ver todos los articulos de '.$parent->cat_name.'" rel="v:url" property="v:title">'.$name.'</a></span>' . $separator;
    } else {
        $string .= $name.$separator;
    }

    return $string;
}


function mybread() {

    global $wp_query;
    $ped = get_query_var('paged');
    $display = '<div xmlns:v="http://rdf.data-vocabulary.org/#">';
    $linkStart = '<span typeof="v:Breadcrumb"><a title="'. get_bloginfo('name') .'" id="breadh" href="'.home_url().'" rel="v:url" property="v:title">'. get_bloginfo('name') .'</a></span>';
    $start = '<span typeof="v:Breadcrumb">'. get_bloginfo('name') .'</span>';

    // si el usuario ha definido una página como página de inicio
    if ( is_front_page() ) {
      $display .= $start;
    } else {
        // probamos si una página ha sido definida como delante mostrar una lista de articulos
        if( get_option('show_on_front') == 'page') {
          $url = urldecode(substr($_SERVER['REQUEST_URI'], 1));
          $uri = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
          $posts_page_id = get_option( 'page_for_posts');
          $posts_page_url = get_page_uri($posts_page_id);
          $pos = strpos($uri,$posts_page_url);

          if($pos !== false) {
                $display .= $linkStart.' <span typeof="v:Breadcrumb">Les articles</span>';
          } else {
                $display .= $linkStart;
          }
        } elseif ( is_home()) {
            $display .= $start;
        }
        else {
            $display .= $linkStart;
        }
    // catgories
    if ( is_category() ) {
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);

      if ($thisCat->parent != 0) $display .= " ".myget_category_parents($parentCat, true, " &raquo; ", true);
      if ($thisCat->parent == 0) {$display .= " ";}
      if ( $ped <= 1 ) {$display .= single_cat_title("", false);}
      elseif ( $ped > 1 ) {
        $display .= '<span typeof="v:Breadcrumb"><a href="' . get_category_link( $thisCat ) . '" title="Ver todos los articulos de '.single_cat_title("", false).'" rel="v:url" property="v:title">'.single_cat_title("", false).'</a></span>';}

    } elseif ( is_author()) { // Authors

      global $author;
      $user_info = get_userdata($author);
      $display .= " &raquo; Articulos del autor ".$user_info->display_name."</span>";

    } elseif ( is_tag()) { // Tags
        $tag=single_tag_title("",FALSE);$display .= " &raquo; Articles sur le th&egrave;me <span>".$tag."</span>";
    }
    elseif ( is_date() ) {
        if ( is_day() ) {
            global $wp_locale;
            $display .= '<span typeof="v:Breadcrumb"><a href="'.get_month_link( get_query_var('year'), get_query_var('monthnum') ).'" rel="v:url" property="v:title">'.$wp_locale->get_month( get_query_var('monthnum') ).' '.get_query_var('year').'</a></span> ';
            $display .= " &raquo; Archives pour ".get_the_date();
        } else if ( is_month() ) {
            $display .= " &raquo; Archives pour ".single_month_title(' ',false);
        } else if ( is_year() ) {
          $display .= " &raquo; Archives pour ".get_query_var('year');
        }
    } elseif ( is_archive() && !is_category()) { // posts without categories
        $posttype = get_post_type();
        $tata = get_post_type_object( $posttype );
        $var = '';
        $the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
        $titrearchive = $tata->labels->menu_name;
        if (!empty($the_tax)){$var = $the_tax->labels->name.' ';}
        if (empty($the_tax)){$var = $titrearchive;}

        $display .= ' &raquo; Archivos sobre "'.$var.'"';
    } elseif ( is_search()) { // the research
        $display .= " &raquo; R&eacute;sultats de votre recherche <span>&raquo; ".get_search_query()."</span>";
    } elseif ( is_404()) { // 404 page
        $display .= " &raquo; 404 Page non trouv&eacute;e";
    } elseif ( is_single()) { // Post

        $category = get_the_category();
        $category_id = get_cat_ID( $category[0]->cat_name );

        if ($category_id != 0) {
            $display .= " &raquo; ".myget_category_parents($category_id,TRUE,' &raquo; ')."<span>".the_title('','',FALSE)."</span>";
        } elseif ($category_id == 0) {
            $post_type = get_post_type();
            $tata = get_post_type_object( $post_type );
            $titrearchive = $tata->labels->menu_name;
            $urlarchive = get_post_type_archive_link( $post_type );
            $display .= ' &raquo; <span typeof="v:Breadcrumb"><a class="breadl" href="'.$urlarchive.'" title="'.$titrearchive.'" rel="v:url" property="v:title">'.$titrearchive.'</a></span> &raquo; <span>'.the_title('','',FALSE).'</span>';
        }
    } elseif ( is_page()) { // Page
        $post = $wp_query->get_queried_object();
        
        if ( $post->post_parent == 0 ) {
            $display .= " &raquo; ".the_title('','',FALSE)."";
        } elseif ( $post->post_parent != 0 ) {
            $title = the_title('','',FALSE);$ancestors = array_reverse(get_post_ancestors($post->ID));array_push($ancestors, $post->ID);
            
            foreach ( $ancestors as $ancestor ) {
                if ($ancestor != end($ancestors)) {
                    $display .= '&raquo; <span typeof="v:Breadcrumb"><a href="'. get_permalink($ancestor) .'" rel="v:url" property="v:title">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></span>';
                } else {
                    $display .= ' &raquo; '.strip_tags(apply_filters('single_post_title',get_the_title($ancestor))).'';
                }
            }
        }
    }
        if ( $ped >= 1 ) {$display .= ' (Page '.$ped.')';}
    }

    $display .= '</div>';

    echo $display;
}
  
?>
