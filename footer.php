<?php
/**
 * Footer Template
 */
$homepage_id    = get_option('page_on_front');
// Footer Fields
$footer_logo = get_field('footer_logo', $homepage_id);

// Safari Links
$safari_link_1_text = get_field('safari_link_1_text', $homepage_id);
$safari_link_1_url = get_field('safari_link_1_url', $homepage_id);
$safari_link_2_text = get_field('safari_link_2_text', $homepage_id);
$safari_link_2_url = get_field('safari_link_2_url', $homepage_id);
$safari_link_3_text = get_field('safari_link_3_text', $homepage_id);
$safari_link_3_url = get_field('safari_link_3_url', $homepage_id);
$safari_link_4_text = get_field('safari_link_4_text', $homepage_id);
$safari_link_4_url = get_field('safari_link_4_url', $homepage_id);
$safari_link_5_text = get_field('safari_link_5_text', $homepage_id);
$safari_link_5_url = get_field('safari_link_5_url', $homepage_id);

// Camps Links
$camps_link_1_text = get_field('camps_link_1_text', $homepage_id);
$camps_link_1_url = get_field('camps_link_1_url', $homepage_id);
$camps_link_2_text = get_field('camps_link_2_text', $homepage_id);
$camps_link_2_url = get_field('camps_link_2_url', $homepage_id);
$camps_link_3_text = get_field('camps_link_3_text', $homepage_id);
$camps_link_3_url = get_field('camps_link_3_url', $homepage_id);
$camps_link_4_text = get_field('camps_link_4_text', $homepage_id);
$camps_link_4_url = get_field('camps_link_4_url', $homepage_id);
$camps_link_5_text = get_field('camps_link_5_text', $homepage_id);
$camps_link_5_url = get_field('camps_link_5_url', $homepage_id);
$camps_link_6_text = get_field('camps_link_6_text', $homepage_id);
$camps_link_6_url = get_field('camps_link_6_url', $homepage_id);
$camps_link_7_text = get_field('camps_link_7_text', $homepage_id);
$camps_link_7_url = get_field('camps_link_7_url', $homepage_id);

// Location Fields
$location_address = get_field('location_address', $homepage_id);
$location_email = get_field('location_email', $homepage_id);
$location_phone = get_field('location_phone', $homepage_id);
$location_map_image = get_field('location_map_image', $homepage_id);

// Social Media
$social_twitter_url = get_field('social_twitter_url', $homepage_id);
$social_instagram_url = get_field('social_instagram_url', $homepage_id);
$social_linkedin_url = get_field('social_linkedin_url', $homepage_id);
$social_tiktok_url = get_field('social_tiktok_url', $homepage_id);
$social_youtube_url = get_field('social_youtube_url', $homepage_id);
?>

</main>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            
            <!-- Footer Brand Section -->
            <div class="footer-brand">
                <?php if($footer_logo): ?>
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt']); ?>">
                        </a>
                    </div>
                <?php endif; ?>
                
                <!-- Social Media Links -->
                <div class="footer-social">
                    <?php if($social_twitter_url): ?>
                        <a href="<?php echo esc_url($social_twitter_url); ?>" class="social-link" target="_blank" rel="noopener">
                            <span class="social-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($social_instagram_url): ?>
                        <a href="<?php echo esc_url($social_instagram_url); ?>" class="social-link" target="_blank" rel="noopener">
                            <span class="social-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($social_linkedin_url): ?>
                        <a href="<?php echo esc_url($social_linkedin_url); ?>" class="social-link" target="_blank" rel="noopener">
                            <span class="social-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($social_tiktok_url): ?>
                        <a href="<?php echo esc_url($social_tiktok_url); ?>" class="social-link" target="_blank" rel="noopener">
                            <span class="social-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($social_youtube_url): ?>
                        <a href="<?php echo esc_url($social_youtube_url); ?>" class="social-link" target="_blank" rel="noopener">
                            <span class="social-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Safari Links -->
            <div class="footer-column">
                <h4 class="footer-column-title">Safari</h4>
                <ul class="footer-link-list">
                    <?php if($safari_link_1_text && $safari_link_1_url): ?>
                        <li><a href="<?php echo esc_url($safari_link_1_url); ?>"><?php echo esc_html($safari_link_1_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($safari_link_2_text && $safari_link_2_url): ?>
                        <li><a href="<?php echo esc_url($safari_link_2_url); ?>"><?php echo esc_html($safari_link_2_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($safari_link_3_text && $safari_link_3_url): ?>
                        <li><a href="<?php echo esc_url($safari_link_3_url); ?>"><?php echo esc_html($safari_link_3_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($safari_link_4_text && $safari_link_4_url): ?>
                        <li><a href="<?php echo esc_url($safari_link_4_url); ?>"><?php echo esc_html($safari_link_4_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($safari_link_5_text && $safari_link_5_url): ?>
                        <li><a href="<?php echo esc_url($safari_link_5_url); ?>"><?php echo esc_html($safari_link_5_text); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Camps Links -->
            <div class="footer-column">
                <h4 class="footer-column-title">Camps</h4>
                <ul class="footer-link-list">
                    <?php if($camps_link_1_text && $camps_link_1_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_1_url); ?>"><?php echo esc_html($camps_link_1_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_2_text && $camps_link_2_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_2_url); ?>"><?php echo esc_html($camps_link_2_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_3_text && $camps_link_3_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_3_url); ?>"><?php echo esc_html($camps_link_3_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_4_text && $camps_link_4_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_4_url); ?>"><?php echo esc_html($camps_link_4_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_5_text && $camps_link_5_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_5_url); ?>"><?php echo esc_html($camps_link_5_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_6_text && $camps_link_6_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_6_url); ?>"><?php echo esc_html($camps_link_6_text); ?></a></li>
                    <?php endif; ?>
                    <?php if($camps_link_7_text && $camps_link_7_url): ?>
                        <li><a href="<?php echo esc_url($camps_link_7_url); ?>"><?php echo esc_html($camps_link_7_text); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Location Section -->
            <div class="footer-location">
                <h4 class="footer-column-title">Location</h4>
                
                <?php if($location_map_image): ?>
                    <div class="location-map">
                        <img src="<?php echo esc_url($location_map_image['url']); ?>" alt="<?php echo esc_attr($location_map_image['alt'] ?: 'Location Map'); ?>">
                    </div>
                <?php endif; ?>
                
                <div class="location-info">
                    <?php if($location_address): ?>
                        <div class="location-item">
                            <strong>Address:</strong> <?php echo esc_html($location_address); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($location_email): ?>
                        <div class="location-item">
                            <strong>Email:</strong> <a href="mailto:<?php echo esc_attr($location_email); ?>"><?php echo esc_html($location_email); ?></a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($location_phone): ?>
                        <div class="location-item">
                            <strong>Tel:</strong> <?php echo esc_html($location_phone); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>