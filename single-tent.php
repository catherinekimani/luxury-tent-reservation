<?php
/**
 * Single Tent Template
 * Template for displaying individual tent details
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); 
    // Get ACF fields
    $tent_subtitle = get_field('tent_subtitle');
    $tent_price = get_field('tent_price');
    $tent_duration = get_field('tent_duration');
    $tent_location = get_field('tent_location');
    $tent_gallery = get_field('tent_gallery');
    $tent_description = get_field('tent_description');
    $tent_capacity = get_field('tent_capacity');
    
    $tent_image_1 = get_field('tent_image_1');
    $tent_image_2 = get_field('tent_image_2');
    $tent_image_3 = get_field('tent_image_3');
    $tent_image_4 = get_field('tent_image_4');
    
    $review_1_name = get_field('review_1_name');
    $review_1_rating = get_field('review_1_rating');
    $review_1_content = get_field('review_1_content');
    $review_1_avatar = get_field('review_1_avatar');
    
    $review_2_name = get_field('review_2_name');
    $review_2_rating = get_field('review_2_rating');
    $review_2_content = get_field('review_2_content');
    $review_2_avatar = get_field('review_2_avatar');
    
    $review_3_name = get_field('review_3_name');
    $review_3_rating = get_field('review_3_rating');
    $review_3_content = get_field('review_3_content');
    $review_3_avatar = get_field('review_3_avatar');
    
    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>

<main class="tent-detail-page">
    
    <!-- Tent Header Section -->
    <section class="tent-header">
        <div class="tent-header-container">
            <div class="tent-info">
                <h1 class="tent-title"><?php the_title(); ?></h1>
                <?php if($tent_subtitle): ?>
                    <p class="tent-subtitle"><?php echo esc_html($tent_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Tent Content Section -->
    <section class="tent-content">
        <div class="tent-content-container">
            
            <!-- Left Column: Images and Description -->
            <div class="tent-left-column">
                
                <div class="tent-gallery">
                    <?php 
                    $gallery_images = array();
                    
                    if($featured_image) {
                        $gallery_images[] = array('url' => $featured_image, 'alt' => get_the_title());
                    }
                    
                    if($tent_image_1) $gallery_images[] = array('url' => $tent_image_1['url'], 'alt' => $tent_image_1['alt']);
                    if($tent_image_2) $gallery_images[] = array('url' => $tent_image_2['url'], 'alt' => $tent_image_2['alt']);
                    if($tent_image_3) $gallery_images[] = array('url' => $tent_image_3['url'], 'alt' => $tent_image_3['alt']);
                    if($tent_image_4) $gallery_images[] = array('url' => $tent_image_4['url'], 'alt' => $tent_image_4['alt']);

                    while(count($gallery_images) < 4 && !empty($gallery_images)) {
                        $gallery_images[] = $gallery_images[0];
                    }
                    ?>
                    
                    <?php if(!empty($gallery_images)): ?>
                        <?php for($i = 0; $i < 4 && $i < count($gallery_images); $i++): ?>
                            <div class="gallery-item">
                                <img src="<?php echo esc_url($gallery_images[$i]['url']); ?>" alt="<?php echo esc_attr($gallery_images[$i]['alt']); ?>">
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

                <!-- Property Description -->
                <div class="tent-description">
                    <h3>About this Property</h3>
                    <?php if($tent_description): ?>
                        <div class="description-content">
                            <?php echo wp_kses_post($tent_description); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(get_the_content()): ?>
                        <div class="additional-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Booking Form -->
            <div class="tent-right-column">
                <div class="booking-card">
                    <h3>Confirm Reservation</h3>
                    
                    <form class="booking-form" method="get" action="<?php echo home_url('/reservation'); ?>">
                        <input type="hidden" name="tent_id" value="<?php echo get_the_ID(); ?>">
                        <input type="hidden" name="price_per_night" value="<?php echo $tent_price ? intval($tent_price) : 22000; ?>">
                        <input type="hidden" id="price_per_night" value="<?php echo $tent_price ? intval($tent_price) : 22000; ?>">

                        <!-- Camps Selection -->
                        <div class="form-group">
                            <label for="camps">Camps</label>
                            <select id="camps" name="camps" class="form-control">
                                <option value=""><?php echo esc_html(get_the_title()); ?></option>
                            </select>
                        </div>
                        
                        <!-- Date Selection -->
                        <div class="form-row">
                            <div class="form-group half">
                                <label for="checkin">Check-in</label>
                                <input type="date" id="checkin" name="check_in" class="form-control" placeholder="DD/MM/YY" required>
                            </div>
                            <div class="form-group half">
                                <label for="checkout">Check-out</label>
                                <input type="date" id="checkout" name="check_out" class="form-control" placeholder="DD/MM/YY" required>
                            </div>
                        </div>

                        <!-- Tents Availability -->
                        <div class="form-group">
                            <label for="tents">Tents Availability</label>
                            <select id="tents" name="num_tents" class="form-control" required>
                                <option value="">Select number of tents</option>
                                <option value="1">1 Tent</option>
                                <option value="2">2 Tents</option>
                                <option value="3">3 Tents</option>
                            </select>
                        </div>

                        <!-- Guests -->
                        <div class="form-group">
                            <label for="guests">Guests</label>
                            <select id="guests" name="num_guests" class="form-control" required>
                                <option value="">Select number of guests</option>
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
                        </div>

                        <!-- Total Price -->
                        <div class="booking-total">
                            <div class="total-row">
                                <span class="total-label">Total</span>
                                <span class="total-price">KES <span id="calculated-total"><?php echo $tent_price ? number_format($tent_price) : '22000'; ?>.00</span></span>
                            </div>
                        </div>

                        <!-- Reserve Button -->
                        <button type="submit" class="reserve-btn">Reserve</button>
                        
                    </form>
                </div>
            </div>

        </div>
    </section>
    
    <!-- Reviews Section -->
    <?php if($review_1_name || $review_2_name || $review_3_name): ?>
        <div class="tent-reviews">
            <h3><?php echo esc_html(get_the_title()); ?> Reviews</h3>
            <div class="reviews-grid">
                
                <!-- Review 1 -->
                <?php if($review_1_name): ?>
                    <div class="review-card">
                        <div class="review-rating">
                            <?php
                            $rating = $review_1_rating ?: 5;
                            for($i = 1; $i <= 5; $i++):
                            ?>
                                <span class="star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        
                        <?php if($review_1_content): ?>
                            <div class="review-content">
                                <p><?php echo esc_html($review_1_content); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="review-author">
                            <?php if($review_1_avatar): ?>
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url($review_1_avatar['url']); ?>" alt="<?php echo esc_attr($review_1_name); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="author-name"><?php echo esc_html($review_1_name); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Review 2 -->
                <?php if($review_2_name): ?>
                    <div class="review-card">
                        <div class="review-rating">
                            <?php
                            $rating = $review_2_rating ?: 5;
                            for($i = 1; $i <= 5; $i++):
                            ?>
                                <span class="star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        
                        <?php if($review_2_content): ?>
                            <div class="review-content">
                                <p><?php echo esc_html($review_2_content); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="review-author">
                            <?php if($review_2_avatar): ?>
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url($review_2_avatar['url']); ?>" alt="<?php echo esc_attr($review_2_name); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="author-name"><?php echo esc_html($review_2_name); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Review 3 -->
                <?php if($review_3_name): ?>
                    <div class="review-card">
                        <div class="review-rating">
                            <?php
                            $rating = $review_3_rating ?: 5;
                            for($i = 1; $i <= 5; $i++):
                            ?>
                                <span class="star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        
                        <?php if($review_3_content): ?>
                            <div class="review-content">
                                <p><?php echo esc_html($review_3_content); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="review-author">
                            <?php if($review_3_avatar): ?>
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url($review_3_avatar['url']); ?>" alt="<?php echo esc_attr($review_3_name); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="author-name"><?php echo esc_html($review_3_name); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    <?php endif; ?>
    
    <!-- CTA Section -->
    <?php get_template_part('template-parts/cta-section'); ?>
</main>



<?php endwhile; ?>

<?php get_footer(); ?>