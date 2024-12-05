<?php
add_action( 'after_setup_theme', 'sshpros_setup' );
function sshpros_setup() {
load_theme_textdomain( 'sshpros', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'appearance-tools' );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'sshpros' ) ) );
}


add_action( 'wp_enqueue_scripts', 'sshpros_enqueue' );

function sshpros_enqueue() {
    wp_enqueue_style( 'sshpros-style', get_stylesheet_uri() );
    wp_enqueue_style('sshpros-extra-style', get_theme_file_uri('header.css') );
    wp_enqueue_script( 'sshpros-script', get_theme_file_uri('script.js'), array(), '1.0.0', true );
}


add_action( 'wp_footer', 'sshpros_footer' );
function sshpros_footer() {}

add_filter( 'document_title_separator', 'sshpros_document_title_separator' );
function sshpros_document_title_separator( $sep ) {
    $sep = esc_html( '|' );
    return $sep;
}
add_filter( 'the_title', 'sshpros_title' );
function sshpros_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function sshpros_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'sshpros_schema_url', 10 );
function sshpros_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'sshpros_wp_body_open' ) ) {
function sshpros_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'sshpros_skip_link', 5 );
function sshpros_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'sshpros' ) . '</a>';
}
add_filter( 'the_content_more_link', 'sshpros_read_more_link' );
function sshpros_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'sshpros' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'sshpros_excerpt_read_more_link' );
function sshpros_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'sshpros' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'sshpros_image_insert_override' );
function sshpros_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'sshpros_widgets_init' );
function sshpros_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'sshpros' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'sshpros_pingback_header' );
function sshpros_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'sshpros_enqueue_comment_reply_script' );
function sshpros_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function sshpros_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'sshpros_comment_count', 0 );
function sshpros_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}