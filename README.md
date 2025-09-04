# Luxury Tent Reservation Theme
<p> A custom WordPress theme for a luxury tent booking journey. The theme provides a responsive frontend, a dynamic backend using WordPress, and a complete reservation flow.</p>


## Features
- **Homepage** with hero, content sections, and call-to-action
- **Reservation Page** to select dates, number of tents, and guest info
- **Confirmation Page** showing booking success
- **Single Tent Template** displaying individual tent details
- **Template Parts** for modular sections (hero, content, CTA)
- **Theme Setup** with registered menus, enqueued assets, and WordPress supports

## Tech Stack
- WordPress (PHP, MySQL)
- HTML, CSS, JavaScript
- Git & GitHub for version control

## Setup Instructions

### 1. Install WordPress
1. Download [WordPress](https://wordpress.org/download/).
2. Set up a local server (XAMPP).
3. Create a MySQL database, e.g. `luxury_tent_db`.
4. Run the WordPress installer at `http://localhost/your-folder`.

### 2. Install Required Plugins
- **Advanced Custom Fields (ACF)** for managing tent details.

### 3. Add the Theme
1. Clone this repository:
   ```bash
   git clone https://github.com/catherinekimani/luxury-tent-reservation.git

2. Copy the theme into your WordPress installation:
	```bash
	wp-content/themes/luxury-tent/

3. In WordPress Admin, go to Appearance > Themes and activate Luxury Tent.
4. Configure Content

   - Use ACF fields or WordPress admin to add tent details, prices, and availability.

   - Create pages for Reservation and Confirmation and assign the provided templates.

5. Test the Reservation Flow

   - Open the homepage, view most experienced section and select a package to view

   - Select dates, tents, and guests.

   - Submit the reservation form.

   - Confirm that the booking is stored and a success page is displayed.

## Project Structure
	luxury-tent-reservation/
	├── assets/                # CSS, JS
	├── front-page.php         # Main
	├── header.php             # Site header
	├── footer.php             # Site footer
	├── index.php              # Fallback template
	├── functions.php          # Theme setup & functions
	├── page-reservation.php   # Reservation form page
	├── page-confirmation.php  # Confirmation page
	├── single-tent.php        # Tent details page
	├── template-parts/        # Homepage sections (hero, content, CTA)
	└── style.css              # Main stylesheet (with theme header)

## Git Workflow

- main → stable release branch
- dev → active development branch


