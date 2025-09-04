<?php
/**
 * Content Sections Template Part
 * Includes: About, Most Booked Experiences, Testimonials, CTA
 */

// About Section Fields
$about_title = get_field('about_title') ?: '';
$about_content = get_field('about_content') ?: '';
$about_button_text = get_field('about_button_text') ?: '';
$about_button_url = get_field('about_button_url') ?: '';
$about_background_image = get_field('about_background_image');

// Most Booked Experiences Fields
$experiences_title = get_field('experiences_title') ?: '';
$experiences_cards = get_field('experiences_cards') ?: array();

// Testimonials Fields
$testimonials_title = get_field('testimonials_title') ?: '';
$testimonials_data = get_field('testimonials_data') ?: array();

?>

<!-- About Bunduz Section -->
<section class="about-bunduz-section" <?php if($about_background_image): ?>style="background-image: url('<?php echo esc_url($about_background_image['url']); ?>');"<?php endif; ?>>
    <div class="about-overlay"></div>
    <div class="about-container">
        <div class="about-content">
            <?php if($about_title): ?>
                <h2 class="about-title"><?php echo esc_html($about_title); ?></h2>
            <?php endif; ?>
            
            <?php if($about_content): ?>
                <div class="about-text">
                    <?php echo wp_kses_post($about_content); ?>
                </div>
            <?php endif; ?>
            
            <?php if($about_button_text && $about_button_url): ?>
                <a href="<?php echo esc_url($about_button_url); ?>" class="about-btn">
                    <?php echo esc_html($about_button_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Most Booked Experiences Section -->
<section class="experiences-section">
    <div class="experiences-container">
        <?php if($experiences_title): ?>
            <h2 class="experiences-title"><?php echo esc_html($experiences_title); ?></h2>
        <?php endif; ?>
        
        <div class="experiences-grid">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php $experience = get_field("experience_card_{$i}"); ?>
                <?php if($experience): ?>
                    <div class="experience-card">
                        <a href="<?php echo esc_url($experience['link'] ?? '#'); ?>" class="experience-link">
                            <div class="experience-image">
                                <?php if(!empty($experience['image'])): ?>
                                    <img src="<?php echo esc_url($experience['image']['url']); ?>" alt="<?php echo esc_attr($experience['title'] ?? ''); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="experience-placeholder"></div>
                                <?php endif; ?>
                                <div class="experience-overlay"></div>
                                <div class="experience-content">
                                    <h3 class="experience-name"><?php echo esc_html($experience['title'] ?? ''); ?></h3>
                                    <div class="experience-meta">
                                        <?php if(!empty($experience['duration'])): ?>
                                            <p class="experience-duration"><?php echo esc_html($experience['duration']); ?></p>
                                        <?php endif; ?>
                                        <?php if(!empty($experience['price_range'])): ?>
                                            <p class="experience-price"><?php echo esc_html($experience['price_range']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <button class="experience-btn">
                                        <?php echo esc_html($experience['button_text'] ?? 'View Package'); ?>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<?php 
$testimonials_title = get_field('testimonials_title');
?>

<section class="testimonials-section">
    <div class="testimonials-container">
        <?php if($testimonials_title): ?>
            <h2 class="testimonials-title"><?php echo esc_html($testimonials_title); ?></h2>
        <?php endif; ?>
        
        <div class="testimonials-grid">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php $testimonial = get_field("testimonial_{$i}"); ?>
                <?php if($testimonial): ?>
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <?php
                            $rating = $testimonial['rating'] ?? 5;
                            for($j = 1; $j <= 5; $j++):
                            ?>
                                <span class="star <?php echo $j <= $rating ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        
                        <?php if(!empty($testimonial['content'])): ?>
                            <div class="testimonial-content">
                                <p><?php echo esc_html($testimonial['content']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="testimonial-author">
                            <?php if(!empty($testimonial['author_avatar'])): ?>
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url($testimonial['author_avatar']['url']); ?>" alt="<?php echo esc_attr($testimonial['author_name'] ?? ''); ?>">
                                </div>
                            <?php endif; ?>
                            
                            <?php if(!empty($testimonial['author_name'])): ?>
                                <div class="author-name"><?php echo esc_html($testimonial['author_name']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<?php get_template_part('template-parts/cta-section'); ?>