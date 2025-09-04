<?php
/**
 * Hero Section Template Part - Combined with Camps & Safaris
 */

// Get Hero ACF fields (with fallbacks for development)
$hero_background = get_field('hero_background_image');
$hero_title = get_field('hero_title') ?: 'Camps. Safaris. Connect.';
$hero_subtitle = get_field('hero_subtitle') ?: '';

// Action buttons
$btn1_text = get_field('hero_btn1_text') ?: 'Stay with Us';
$btn1_url = get_field('hero_btn1_url') ?: '#';
$btn1_icon = get_field('hero_btn1_icon') ?: 'tent';

$btn2_text = get_field('hero_btn2_text') ?: 'Join a Safari';
$btn2_url = get_field('hero_btn2_url') ?: '#';
$btn2_icon = get_field('hero_btn2_icon') ?: 'binoculars';

$btn3_text = get_field('hero_btn3_text') ?: 'Restaurant';
$btn3_url = get_field('hero_btn3_url') ?: '#';
$btn3_icon = get_field('hero_btn3_icon') ?: 'restaurant';

// Booking form settings
$show_booking_form = get_field('show_booking_form') !== false;

// Get Camps & Safaris ACF fields
$section_title_camps = get_field('camps_section_title') ?: 'Camps';
$section_title_safaris = get_field('safaris_section_title') ?: 'Safaris';
$active_tab = get_field('default_active_tab') ?: 'camps';

$cards_data = array();

for ($i = 1; $i <= 6; $i++) {
    $title = get_field("card_{$i}_title");
    $image = get_field("card_{$i}_image");
    $link = get_field("card_{$i}_link");
    $category = get_field("card_{$i}_category");
    $has_arrow = get_field("card_{$i}_has_arrow");
    
    if ($title) {
        $cards_data[] = array(
            'title' => $title,
            'image' => $image,
            'link' => $link ?: '#',
            'category' => $category ?: 'camps',
            'has_arrow' => $has_arrow
        );
    }
}
?>

<div class="hero-camps-wrapper">
    <!-- Hero Section -->
    <section class="hero-section" <?php if($hero_background): ?>style="background-image: url('<?php echo esc_url($hero_background['url']); ?>');"<?php endif; ?>>
        <div class="hero-overlay"></div>
        
        <div class="hero-container">
            <div class="hero-content">
                
                <!-- Main Headline -->
                <div class="hero-headline">
                    <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                </div>

                <!-- Action Buttons -->
                <div class="hero-actions">
                    <a href="<?php echo esc_url($btn1_url); ?>" class="hero-btn hero-btn-primary">
                        <span class="btn-icon btn-icon-<?php echo esc_attr($btn1_icon); ?>"></span>
                        <span><?php echo esc_html($btn1_text); ?></span>
                    </a>
                    
                    <a href="<?php echo esc_url($btn2_url); ?>" class="hero-btn hero-btn-secondary">
                        <span class="btn-icon btn-icon-<?php echo esc_attr($btn2_icon); ?>"></span>
                        <span><?php echo esc_html($btn2_text); ?></span>
                    </a>
                    
                    <a href="<?php echo esc_url($btn3_url); ?>" class="hero-btn hero-btn-secondary">
                        <span class="btn-icon btn-icon-<?php echo esc_attr($btn3_icon); ?>"></span>
                        <span><?php echo esc_html($btn3_text); ?></span>
                    </a>
                </div>

                <?php if($show_booking_form): ?>
                <!-- Booking Widget -->
                <div class="hero-booking-widget">
                    <form class="booking-form" method="post" action="">
                        <?php wp_nonce_field('hero_booking_nonce', 'booking_nonce'); ?>
                        
                        <div class="booking-row">
                            <div class="booking-field">
                                <label for="camp-type"><?php echo esc_html(get_field('booking_label_camps') ?: 'Camps'); ?></label>
                                <select id="camp-type" name="camp_type" required>
                                    <option value=""><?php echo esc_html(get_field('booking_placeholder_camps') ?: 'Luxury Tents'); ?></option>
                                    <?php
                                    // Get available tents/camps
                                    $tents = get_posts(array(
                                        'post_type' => 'tent',
                                        'numberposts' => -1,
                                        'post_status' => 'publish'
                                    ));
                                    foreach($tents as $tent):
                                    ?>
                                        <option value="<?php echo $tent->ID; ?>"><?php echo esc_html($tent->post_title); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="booking-field">
                                <label for="check-in"><?php echo esc_html(get_field('booking_label_checkin') ?: 'Check in'); ?></label>
                                <input type="date" id="check-in" name="check_in" placeholder="<?php echo esc_attr(get_field('booking_placeholder_checkin') ?: 'Fri 5/10'); ?>" required>
                            </div>
                            
                            <div class="booking-field">
                                <label for="check-out"><?php echo esc_html(get_field('booking_label_checkout') ?: 'Check out'); ?></label>
                                <input type="date" id="check-out" name="check_out" placeholder="<?php echo esc_attr(get_field('booking_placeholder_checkout') ?: 'Fri 5/16'); ?>" required>
                            </div>
                            
                            <div class="booking-field">
                                <label for="guests"><?php echo esc_html(get_field('booking_label_guests') ?: 'Guests'); ?></label>
                                <select id="guests" name="guests" required>
                                    <option value=""><?php echo esc_html(get_field('booking_placeholder_guests') ?: 'Guests'); ?></option>
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo $i == 1 ? 'Guest' : 'Guests'; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            
                            <div class="booking-submit">
                                <button type="submit" class="search-btn">
                                    <?php echo esc_html(get_field('booking_button_text') ?: 'Search'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Camps & Safaris Section -->
    <section class="camps-safaris-section">
        <div class="camps-safaris-container">
            
            <div class="section-tabs">
                <button class="tab-btn <?php echo $active_tab === 'camps' ? 'active' : ''; ?>" data-tab="camps">
                    <?php echo esc_html($section_title_camps); ?>
                </button>
                <button class="tab-btn <?php echo $active_tab === 'safaris' ? 'active' : ''; ?>" data-tab="safaris">
                    <?php echo esc_html($section_title_safaris); ?>
                </button>
            </div>

            <!-- Cards Grid -->
            <div class="cards-grid" id="camps-safaris-grid">
                <?php foreach ($cards_data as $index => $card): ?>
                    <div class="card-item" data-category="<?php echo esc_attr($card['category'] ?? 'camps'); ?>">
                        <a href="<?php echo esc_url($card['link'] ?? '#'); ?>" class="card-link">
                            <div class="card-image">
                                <?php if (!empty($card['image'])): ?>
                                    <img src="<?php echo esc_url($card['image']['url']); ?>" alt="<?php echo esc_attr($card['title']); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="card-placeholder" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                                <?php endif; ?>
                                
                                <div class="card-overlay"></div>
                                
                                <div class="card-content">
                                    <h3 class="card-title"><?php echo esc_html($card['title']); ?></h3>
                                    
                                    <?php if (!empty($card['has_arrow'])): ?>
                                        <span class="card-arrow">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const cards = document.querySelectorAll('.card-item');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Update active tab
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (targetTab === 'camps' || targetTab === 'safaris') {
                    if (card.dataset.category === targetTab) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>