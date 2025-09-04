<?php
/**
 * Template Name: Confirmation Page
 */

get_header();

// Confirmation Page Fields
$page_title = get_field('confirmation_title');
$success_message = get_field('success_message');
$dashboard_button_text = get_field('dashboard_button_text');
$dashboard_url = get_field('dashboard_url');
$icon_type = get_field('icon_type');
$background_overlay = get_field('background_overlay_opacity');

// Get booking ID from URL
$booking_id = isset($_GET['booking_id']) ? esc_attr($_GET['booking_id']) : '';
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/confirmation.css">

<main class="confirmation-main">
    <div class="confirmation-overlay" style="background-color: rgba(0, 0, 0, <?php echo $background_overlay ?: '0.6'; ?>);">
        <div class="confirmation-modal">
            <div class="confirmation-content">
                <!-- Success Icon -->
                <div class="success-icon">
                    <?php if($icon_type === 'custom' && get_field('custom_icon')): ?>
                        <img src="<?php echo esc_url(get_field('custom_icon')['url']); ?>" alt="Success">
                    <?php else: ?>
                        <div class="checkmark-circle">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M25 35L15 25L18 22L25 29L42 12L45 15L25 35Z" fill="currentColor"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Confirmation Title -->
                <h1 class="confirmation-title">
                    <?php echo $page_title ? esc_html($page_title) : 'Booking Confirmed!'; ?>
                </h1>

                <!-- Success Message -->
                <div class="confirmation-message">
                    <?php if($success_message): ?>
                        <p><?php echo esc_html($success_message); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Action Button -->
                <div class="confirmation-actions">
                    <?php if($dashboard_url): ?>
                        <a href="<?php echo esc_url($dashboard_url); ?>" class="dashboard-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 13H9V3H3V13ZM3 21H9V15H3V21ZM11 21H21V11H11V21ZM11 3V9H21V3H11Z" fill="currentColor"/>
                            </svg>
                            <?php echo $dashboard_button_text ? esc_html($dashboard_button_text) : 'Continue to Dashboard'; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Booking Reference (if booking ID exists) -->
                <?php if($booking_id && get_field('show_booking_reference')): ?>
                    <div class="booking-reference">
                        <p class="reference-label"><?php echo esc_html(get_field('booking_reference_label') ?: 'Booking Reference:'); ?></p>
                        <p class="reference-number"><?php echo esc_html($booking_id); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Additional Information -->
                <?php if(get_field('additional_info')): ?>
                    <div class="additional-info">
                        <p><?php echo esc_html(get_field('additional_info')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if(get_field('auto_redirect_enabled')): ?>
        const redirectDelay = <?php echo intval(get_field('auto_redirect_delay') ?: 5); ?> * 1000;
        const redirectUrl = '<?php echo esc_js($dashboard_url); ?>';
        
        if(redirectUrl) {
            setTimeout(function() {
                window.location.href = redirectUrl;
            }, redirectDelay);
        }
    <?php endif; ?>

    const modal = document.querySelector('.confirmation-modal');
    if(modal) {
        setTimeout(function() {
            modal.classList.add('animate-in');
        }, 100);
    }

    const dashboardBtn = document.querySelector('.dashboard-btn');
    if(dashboardBtn) {
        dashboardBtn.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
});
</script>

<?php get_footer(); ?>