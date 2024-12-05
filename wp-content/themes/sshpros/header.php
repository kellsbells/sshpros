<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php sshpros_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" class="header" role="banner">
            <div class="container">
                <div id="branding" class="branding">
                    <a href="<?php echo esc_url(home_url( '/' )) ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )) ?>" rel="home" itemprop="url">
                        <div id="site-title" class="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sshpros-logo-white.png" alt="SSHPros Logo" />
                            <h1 itemprop="name"><?php echo esc_html( get_bloginfo( 'name' ) ) ?></h1>
                        </div>
                    </a>
                </div>

                <nav id="menu" class="toggle-nav" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <div class="hamburger">
                        <span class="open">&#9776;</span>
                        <span class="close">&#x002B;</span>
                    </div>
                    <div class="nav-items">
                        <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                    </div>
                </nav>
            </div>
        </header>
        <div id="container">
            <main id="content" role="main">