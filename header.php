<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">

        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                }
                ?>
            </a>
        </div>

        <nav class="header-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false
            ));
            ?>
        </nav>

        <div class="header-actions">

            <!-- Sign In button -->
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="sign-in">
                <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path fill="currentColor" d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                </svg>
                <span>Sign In</span>
            </a>

            <!-- Plan your trip CTA -->
            <a href="<?php echo esc_url(home_url('/reservation')); ?>" class="book-now-btn">
                <span class="trip-icon" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3L1 21h22L12 3z" fill="#fff"/>
                        <path d="M12 9v4" stroke="#c81b1b" stroke-width="1.2" stroke-linecap="round"/>
                    </svg>
                </span>
                Plan your trip
            </a>

        </div>
    </div>
</header>

<main class="site-main">
<?php
// Only show hero and content sections on homepage
if (is_front_page() || is_home()):
    // hero section
    get_template_part('template-parts/hero-section');
    // Content sections (About, Experiences, Testimonials, CTA)
    get_template_part('template-parts/content-sections');
endif;

if (is_front_page() || is_home()):
else:
endif;
?>