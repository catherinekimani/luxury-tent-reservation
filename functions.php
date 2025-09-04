<?php
/**
 * Bunduz Theme Functions
 */

// -------------------------
// Theme Setup
// -------------------------
function bunduz_theme_setup() {
	// Theme support
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	add_theme_support('html5', array('search-form', 'comment-form'));
	add_theme_support('custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	));

	// Register nav menus
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'bunduz'),
		'footer'  => __('Footer Menu', 'bunduz'),
	));

	// Add image sizes
	add_image_size('tent-card', 400, 300, true);
	add_image_size('tent-hero', 800, 450, true);
	add_image_size('tent-gallery', 600, 400, true);
}
add_action('after_setup_theme', 'bunduz_theme_setup');

// -------------------------
// Enqueue Scripts & Styles
// -------------------------
function bunduz_enqueue_scripts() {
	// Styles
	wp_enqueue_style(
		'bunduz-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get('Version')
	);

	// Scripts - Fixed duplicate 'bunduz-main' handle
	wp_enqueue_script(
		'bunduz-tent-reservation',
		get_template_directory_uri() . '/assets/js/tent-reservation.js',
		array('jquery'),
		'1.0.0',
		true
	);
	
	wp_enqueue_script(
		'bunduz-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array('jquery'),
		'1.0.0',
		true
	);

	wp_enqueue_script(
		'bunduz-booking',
		get_template_directory_uri() . '/assets/js/booking.js',
		array('jquery'),
		'1.0.0',
		true
	);

	// Localize script for AJAX
	wp_localize_script('bunduz-booking', 'bunduz_ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('bunduz_nonce'),
	));
}
add_action('wp_enqueue_scripts', 'bunduz_enqueue_scripts');

// -------------------------
// Custom Post Types
// -------------------------
function bunduz_register_post_types() {
	// Tents CPT
	register_post_type('tent', array(
		'labels' => array(
			'name'               => __('Tents & Camps', 'bunduz'),
			'singular_name'      => __('Tent', 'bunduz'),
			'add_new'            => __('Add New Tent', 'bunduz'),
			'add_new_item'       => __('Add New Tent', 'bunduz'),
			'edit_item'          => __('Edit Tent', 'bunduz'),
			'new_item'           => __('New Tent', 'bunduz'),
			'view_item'          => __('View Tent', 'bunduz'),
			'search_items'       => __('Search Tents', 'bunduz'),
			'not_found'          => __('No tents found', 'bunduz'),
			'not_found_in_trash' => __('No tents found in Trash', 'bunduz'),
		),
		'public'        => true,
		'has_archive'   => true,
		'menu_position' => 5,
		'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'rewrite'       => array('slug' => 'tents'),
		'show_in_rest'  => true,
	));

	// Bookings CPT
	register_post_type('booking', array(
		'labels' => array(
			'name'          => __('Bookings', 'bunduz'),
			'singular_name' => __('Booking', 'bunduz'),
		),
		'public'      => false,
		'show_ui'     => true,
		'supports'    => array('title', 'custom-fields'),
		'menu_icon'   => 'dashicons-calendar-alt',
	));
}
add_action('init', 'bunduz_register_post_types');

// -------------------------
// Create Database Tables
// -------------------------
function bunduz_create_database_tables() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	// Reservations Table
	$sql_reservations = "CREATE TABLE $reservations_table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		tent_id mediumint(9) NOT NULL,
		check_in date NOT NULL,
		check_out date NOT NULL,
		num_tents int NOT NULL DEFAULT 1,
		num_guests int NOT NULL DEFAULT 1,
		first_name varchar(100) NOT NULL,
		last_name varchar(100) NOT NULL,
		id_passport varchar(50) NOT NULL,
		date_of_birth date NOT NULL,
		email varchar(100) NOT NULL,
		phone varchar(20) NOT NULL,
		status varchar(20) DEFAULT 'pending',
		total_price decimal(10,2) DEFAULT 0.00,
		created_at datetime DEFAULT CURRENT_TIMESTAMP,
		updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		INDEX tent_dates (tent_id, check_in, check_out),
		INDEX guest_email (email),
		INDEX booking_status (status)
	) $charset_collate;";

	// Tent Bookings Table
	$bookings_table = $wpdb->prefix . 'tent_bookings';
	$sql_bookings = "CREATE TABLE $bookings_table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		tent_id mediumint(9) NOT NULL,
		guest_name tinytext NOT NULL,
		guest_email varchar(100) NOT NULL,
		guest_phone varchar(15) NOT NULL,
		check_in_date date NOT NULL,
		check_out_date date NOT NULL,
		num_guests int NOT NULL,
		total_price decimal(10,2) NOT NULL,
		booking_status varchar(20) DEFAULT 'pending',
		special_requests text,
		created_at datetime DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql_reservations);
	
	$result = dbDelta($sql_reservations);
	error_log('Table creation result: ' . print_r($result, true));
}
add_action('after_switch_theme', 'bunduz_create_database_tables');

function bunduz_force_create_tables() {
	bunduz_create_database_tables();
}

// check if table exists
function bunduz_check_table_exists() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'reservations';
	$table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
	
	if ($table_exists) {
		error_log("Table $table_name exists");
		return true;
	} else {
		error_log("Table $table_name does NOT exist");
		return false;
	}
}

// AJAX Handlers
function bunduz_process_reservation() {
	check_ajax_referer('bunduz_reservation', 'reservation_nonce');

	global $wpdb;
	$table_name = $wpdb->prefix . 'reservations';
	
	$table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
	if (!$table_exists) {
		error_log("Table $table_name does not exist!");
		wp_send_json_error(['message' => 'Database table not found. Please contact administrator.']);
		return;
	}

	// validate input data
	$tent_id = intval($_POST['tent_id']);
	$check_in = sanitize_text_field($_POST['check_in']);
	$check_out = sanitize_text_field($_POST['check_out']);
	$num_tents = intval($_POST['num_tents']);
	$num_guests = intval($_POST['num_guests']);
	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name = sanitize_text_field($_POST['last_name']);
	$id_passport = sanitize_text_field($_POST['id_passport']);
	$date_of_birth = sanitize_text_field($_POST['date_of_birth']);
	$email = sanitize_email($_POST['email']);
	$phone = sanitize_text_field($_POST['phone']);

	if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
		wp_send_json_error(['message' => 'Required fields are missing']);
		return;
	}

	if (!is_email($email)) {
		wp_send_json_error(['message' => 'Invalid email address']);
		return;
	}

	if (empty($check_in) || empty($check_out)) {
		wp_send_json_error(['message' => 'Check-in and check-out dates are required']);
		return;
	}

	// Calculate total price
	$check_in_date = new DateTime($check_in);
	$check_out_date = new DateTime($check_out);
	$nights = $check_in_date->diff($check_out_date)->days;
	$price_per_night = 22000;
	$total_price = $nights * $num_tents * $price_per_night;

	$data = [
		'tent_id'       => $tent_id,
		'check_in'      => $check_in,
		'check_out'     => $check_out,
		'num_tents'     => $num_tents,
		'num_guests'    => $num_guests,
		'first_name'    => $first_name,
		'last_name'     => $last_name,
		'id_passport'   => $id_passport,
		'date_of_birth' => $date_of_birth,
		'email'         => $email,
		'phone'         => $phone,
		'total_price'   => $total_price,
		'status'        => 'pending',
		'created_at'    => current_time('mysql')
	];

	error_log('Attempting to insert reservation data: ' . print_r($data, true));

	$inserted = $wpdb->insert($table_name, $data);

	if ($wpdb->last_error) {
		error_log('Database error: ' . $wpdb->last_error);
		wp_send_json_error(['message' => 'Database error: ' . $wpdb->last_error]);
		return;
	}

	if ($inserted) {
		$booking_id = $wpdb->insert_id;
		error_log("Reservation saved successfully with ID: $booking_id");
		
		$user_id = email_exists($email);
		if (!$user_id) {
			$user_id = wp_create_user($email, wp_generate_password(), $email);
			if (!is_wp_error($user_id)) {
				wp_update_user([
					'ID' => $user_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'display_name' => $first_name . ' ' . $last_name
				]);
			}
		}

		wp_send_json_success([
			'booking_id' => $booking_id,
			'message'    => 'Reservation successful',
			'user_id'    => $user_id
		]);
	} else {
		error_log('Failed to insert reservation data');
		wp_send_json_error(['message' => 'Could not save reservation. Please try again.']);
	}

	wp_die();
}
add_action('wp_ajax_process_reservation', 'bunduz_process_reservation');
add_action('wp_ajax_nopriv_process_reservation', 'bunduz_process_reservation');

// Utility Functions

// Get booking by ID
function bunduz_get_booking($booking_id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'reservations';
	
	return $wpdb->get_row(
		$wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $booking_id)
	);
}

// Check tent availability
function bunduz_check_tent_availability($tent_id, $check_in, $check_out, $num_tents = 1) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'reservations';
	
	$conflicts = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT SUM(num_tents) FROM $table_name 
			WHERE tent_id = %d 
			AND status IN ('pending', 'confirmed') 
			AND (
				(check_in <= %s AND check_out > %s) OR
				(check_in < %s AND check_out >= %s) OR
				(check_in >= %s AND check_out <= %s)
			)",
			$tent_id, $check_in, $check_in, $check_out, $check_out, $check_in, $check_out
		)
	);
	
	$tent_capacity = get_field('tent_capacity', $tent_id) ?: 3;
	
	$available_tents = $tent_capacity - intval($conflicts);
	
	return $available_tents >= $num_tents;
}

// Admin Customizations
// booking management columns
function bunduz_booking_columns($columns) {
	$columns['booking_id'] = 'Booking ID';
	$columns['guest_info'] = 'Guest Info';
	$columns['dates'] = 'Stay Dates';
	$columns['tent_info'] = 'Tent & Guests';
	$columns['total'] = 'Total Price';
	$columns['status'] = 'Status';
	return $columns;
}

function bunduz_booking_column_content($column, $post_id) {
}

// Email Notifications
function bunduz_send_booking_confirmation($booking_id) {
	$booking = bunduz_get_booking($booking_id);
	if (!$booking) return false;

	$to = $booking->email;
	$subject = 'Booking Confirmation - ' . get_bloginfo('name');
	$message = "Dear {$booking->first_name},\n\n";
	$message .= "Your booking has been confirmed!\n\n";
	$message .= "Booking ID: {$booking_id}\n";
	$message .= "Check-in: {$booking->check_in}\n";
	$message .= "Check-out: {$booking->check_out}\n";
	$message .= "Total: KES " . number_format($booking->total_price, 2) . "\n\n";
	$message .= "Thank you for choosing us!";

	return wp_mail($to, $subject, $message);
}