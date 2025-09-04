<?php
/**
 * Template Name: Reservation Page
 */

get_header();

// Reservation Page Fields
$page_title = get_field('page_title');
$page_subtitle = get_field('page_subtitle');
$tent_selection_title = get_field('tent_selection_title');
$guest_info_title = get_field('guest_info_title');
$additional_guests_note = get_field('additional_guests_note');
$terms_text = get_field('terms_text');

$tent_id    = isset($_GET['tent_id']) ? intval($_GET['tent_id']) : 0;
$check_in   = isset($_GET['check_in']) ? esc_attr($_GET['check_in']) : '';
$check_out  = isset($_GET['check_out']) ? esc_attr($_GET['check_out']) : '';
$num_tents  = isset($_GET['num_tents']) ? intval($_GET['num_tents']) : 1;
$num_guests = isset($_GET['num_guests']) ? intval($_GET['num_guests']) : 1;
$price_per_night = isset($_GET['price_per_night']) ? intval($_GET['price_per_night']) : 22000;
?>

<main class="reservation-main">
    <div class="container">
        <div class="reservation-header">
            <?php if($page_title): ?>
                <h1><?php echo esc_html($page_title); ?></h1>
            <?php else: ?>
                <h1>Confirm Your Guest Information</h1>
            <?php endif; ?>
            
            <?php if($page_subtitle): ?>
                <p><?php echo esc_html($page_subtitle); ?></p>
            <?php else: ?>
                <p>Please confirm the primary guest's information below.</p>
            <?php endif; ?>
        </div>

        <div class="reservation-content">
            <div class="reservation-layout">
                <!-- Left Column - Guest Form -->
                <div class="guest-form-section">
                    <form id="reservation-form" class="reservation-form">
                        <?php wp_nonce_field('bunduz_reservation', 'reservation_nonce'); ?>
                        <input type="hidden" id="tent_id" name="tent_id" value="<?php echo $tent_id; ?>">
                        <input type="hidden" id="check_in" name="check_in" value="<?php echo $check_in; ?>">
                        <input type="hidden" id="check_out" name="check_out" value="<?php echo $check_out; ?>">
                        <input type="hidden" id="num_tents" name="num_tents" value="<?php echo $num_tents; ?>">
                        <input type="hidden" id="num_guests" name="num_guests" value="<?php echo $num_guests; ?>">
                        
                        <!-- Primary Guest Section -->
                        <div class="primary-guest-section">
                            <h2>Primary Guest</h2>
                            
                            <div class="guest-info-grid">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_passport">ID / Passport Number</label>
                                    <input type="text" id="id_passport" name="id_passport" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>

                            <div class="form-note">
                                <p>Your primary guest details are saved, and an account will be created for you. Add other guests now or finish later from your dashboard—we'll email you a secure link.</p>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="complete-reservation-btn">Complete Reservation</button>
                                <button type="button" class="add-guest-btn">+ Add Another Guest</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Column - Booking Summary -->
                <div class="booking-summary">
                    <div class="summary-card">
                        <div class="tent-summary">
                            <div class="tent-image">
                                <?php 
                                $tent_id = isset($_GET['tent_id']) ? intval($_GET['tent_id']) : 0;
                                if ($tent_id) {
                                    $tent_image = get_field('tent_gallery', $tent_id);
                                    if ($tent_image && is_array($tent_image)) {
                                        echo '<img src="' . esc_url($tent_image[0]['url']) . '" alt="' . esc_attr(get_the_title($tent_id)) . '">';
                                    }
                                } else {
                                    // Default tent image
                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/default-tent.jpg" alt="Luxury Tent">';
                                }
                                ?>
                            </div>
                            <div class="tent-title">
                                <h3><?php echo $tent_id ? esc_html(get_the_title($tent_id)) : 'Luxury Tents'; ?></h3>
                                <span class="camp-label">Camps</span>
                            </div>
                        </div>

                        <div class="booking-details">
                            <div class="detail-row">
                                <label>Check-in</label>
                                <span class="date-display" id="checkin-display">
                                <?php echo isset($_GET['check_in']) ? date('D n/j/y', strtotime($_GET['check_in'])) : '-'; ?>
                                    </span>
                            </div>
                            <div class="detail-row">
                                <label>Check-out</label>
                                <span class="date-display" id="checkout-display">
                                    <?php echo isset($_GET['check_out']) ? date('D n/j/y', strtotime($_GET['check_out'])) : '-'; ?>
                                </span>
                            </div>
                            <div class="detail-row">
                                <label for="num_tents_summary">Tents Availability</label>
                                <select id="num_tents_summary" name="num_tents_summary" required>
                                    <option value="">Select number of tents to book</option>
                                    <option value="1" <?php selected($num_tents, 1); ?>>1 Tent</option>
                                    <option value="2" <?php selected($num_tents, 2); ?>>2 Tents</option>
                                    <option value="3" <?php selected($num_tents, 3); ?>>3 Tents</option>
                                </select>
                            </div>
                            <div class="detail-row">
                                <label for="num_guests_summary">Guests</label>
                                <select id="num_guests_summary" name="num_guests_summary" required>
                                    <option value="">Select number of guests</option>
                                    <option value="1" <?php selected($num_guests, 1); ?>>1 Guest</option>
                                    <option value="2" <?php selected($num_guests, 2); ?>>2 Guests</option>
                                    <option value="3" <?php selected($num_guests, 3); ?>>3 Guests</option>
                                    <option value="4" <?php selected($num_guests, 4); ?>>4 Guests</option>
                                </select>
                            </div>
                        </div>

                        <div class="price-summary">
                            <div class="total-row">
                                <span class="total-label">Total</span>
                                <span class="total-price">KES <span id="calculated-total">22000.00</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reservation-form');
    const numTentsInput = document.getElementById('num_tents_summary');
    const numGuestsInput = document.getElementById('num_guests_summary');
    const totalElement = document.getElementById('calculated-total');
    
    // Hidden form inputs
    const hiddenTentsInput = document.getElementById('num_tents');
    const hiddenGuestsInput = document.getElementById('num_guests');
    
    <?php $tent_id = isset($_GET['tent_id']) ? intval($_GET['tent_id']) : 0; ?>
    const pricePerNight = <?php echo $price_per_night; ?>;

    // Get dates from URL parameters or hidden inputs
    const checkInValue = document.getElementById('check_in').value;
    const checkOutValue = document.getElementById('check_out').value;

    // Initialize dropdowns with values from URL parameters
    function initializeDropdowns() {
        // Set number of tents dropdown
        const initialTents = parseInt(hiddenTentsInput.value) || 1;
        numTentsInput.value = initialTents;
        
        // Set number of guests dropdown
        const initialGuests = parseInt(hiddenGuestsInput.value) || 1;
        numGuestsInput.value = initialGuests;
    }

    // Calculate total price
    function calculateTotal() {
        if (!checkInValue || !checkOutValue) {
            totalElement.textContent = '22000.00';
            return;
        }

        const checkIn = new Date(checkInValue);
        const checkOut = new Date(checkOutValue);
        const numTents = parseInt(numTentsInput.value) || 1;

        if (checkIn && checkOut && checkOut > checkIn && numTents > 0) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const total = nights * numTents * pricePerNight;
            totalElement.textContent = total.toLocaleString() + '.00';
        } else {
            totalElement.textContent = '22000.00';
        }
    }

    // Sync dropdown changes with hidden inputs
    function syncDropdownsWithHiddenInputs() {
        hiddenTentsInput.value = numTentsInput.value;
        hiddenGuestsInput.value = numGuestsInput.value;
        calculateTotal();
    }

    // Event listeners for dropdown changes
    numTentsInput.addEventListener('change', syncDropdownsWithHiddenInputs);
    numGuestsInput.addEventListener('change', syncDropdownsWithHiddenInputs);

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Ensure hidden inputs are synced before submission
        syncDropdownsWithHiddenInputs();
        
        const formData = new FormData(form);
        formData.append('action', 'process_reservation');
        
        // Show loading state
        const submitBtn = form.querySelector('.complete-reservation-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Processing...';
        submitBtn.disabled = true;

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '<?php echo home_url('/confirmation'); ?>?booking_id=' + data.booking_id;
            } else {
                alert('Error: ' + data.message);
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            alert('An error occurred. Please try again.');
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });

    // Add guest functionality
    document.querySelector('.add-guest-btn').addEventListener('click', function() {
        // This would open a modal for additional guest details
        alert('Additional guest form would open here');
    });

    // Initialize everything on page load
    initializeDropdowns();
    calculateTotal();
});
</script>

<?php get_footer(); ?>