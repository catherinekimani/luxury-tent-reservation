<?php
/**
 * Template Part: CTA Section
 */

// CTA Section Fields
$cta_background = get_field('cta_background_image');
$cta_title = get_field('cta_title') ?: '';
$cta_button_text = get_field('cta_button_text') ?: '';
$cta_button_url = get_field('cta_button_url') ?: '';
?>

<!-- CTA Section -->
<section class="cta-section" <?php if($cta_background): ?>style="background-image: url('<?php echo esc_url($cta_background['url']); ?>');"<?php endif; ?>>
    <div class="cta-overlay"></div>
    <div class="cta-container">
        <div class="cta-content">
            <?php if($cta_title): ?>
                <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
            <?php endif; ?>
            
            <?php if($cta_button_text && $cta_button_url): ?>
                <a href="<?php echo esc_url($cta_button_url); ?>" class="cta-btn">
                    <svg class="tent-icon" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3L1 21h22L12 3z" fill="currentColor"/>
                    </svg>
                    <?php echo esc_html($cta_button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>