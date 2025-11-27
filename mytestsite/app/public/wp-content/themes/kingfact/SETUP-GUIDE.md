# KingFact Theme - WordPress Site Setup Guide

This guide will help you set up your WordPress site with the KingFact theme.

## Overview

Your theme now includes:
- ✅ Homepage with slider functionality
- ✅ About page template
- ✅ Services page template
- ✅ Contact page template with working form
- ✅ Default page template
- ✅ Custom "Slides" post type for homepage slider
- ✅ Navigation menu support
- ✅ Header customization with ACF
- ✅ Contact form handler

## Step 1: Install Required Plugin (ACF)

The theme uses Advanced Custom Fields (ACF) for header customization.

1. Go to **Plugins → Add New**
2. Search for "Advanced Custom Fields"
3. Install and activate the **Advanced Custom Fields** plugin (free version is sufficient)

## Step 2: Create Pages

Create the following pages in WordPress:

### 2.1 Create Home Page
1. Go to **Pages → Add New**
2. Title: "Home"
3. Template: Select "Home (Enqueue-only)" from the Template dropdown
4. Click **Publish**

### 2.2 Set Homepage as Front Page
1. Go to **Settings → Reading**
2. Select "A static page" under "Your homepage displays"
3. Choose "Home" as your Homepage
4. Click **Save Changes**

### 2.3 Create About Page
1. Go to **Pages → Add New**
2. Title: "About"
3. Template: Select "About — Profile / Vision / Mission / Why Us"
4. Add your content in the editor
5. Click **Publish**

### 2.4 Create Services Page
1. Go to **Pages → Add New**
2. Title: "Services"
3. Template: Select "Services"
4. Add introductory content in the editor
5. Click **Publish**
6. **Note:** The services grid is built into the template. You can edit the services in `page-services.php`

### 2.5 Create Contact Page
1. Go to **Pages → Add New**
2. Title: "Contact"
3. Template: Select "Contact"
4. Optionally add content above the form
5. Click **Publish**
6. **Note:** Update contact information in `page-contact.php` to match your business details

### 2.6 Create Additional Pages (Optional)
Create any other pages you need using the default template:
- Blog
- Portfolio
- Team
- FAQ
- etc.

## Step 3: Create Homepage Slides

The homepage uses a custom slider with the "Slides" post type:

1. Go to **Slides** in the WordPress admin menu
2. Click **Add New Slide**
3. Fill in the slide details:
   - **Title**: Internal name for the slide (e.g., "Slide 1")
   - **Content Editor**: Write the description/paragraph text for the slide
   - **Featured Image**: Set the background image (1920x1080px recommended)
   - **Subtitle**: Small text above the main heading
   - **Big Heading**: Main headline (if empty, the title will be used)
   - **Button Text**: Text for the call-to-action button
   - **Button URL**: Where the button should link to
4. Set **Order** in the "Page Attributes" box (lower numbers appear first)
5. Click **Publish**

**Recommended:** Create 3-5 slides for your homepage

## Step 4: Set Up Navigation Menu

1. Go to **Appearance → Menus**
2. Click "Create a new menu"
3. Name it "Primary Menu"
4. Add your pages to the menu (Home, About, Services, Contact, etc.)
5. Under "Menu Settings", check "Primary Menu"
6. Click **Save Menu**

### Optional: Footer Menu
1. Create another menu named "Footer Menu"
2. Add relevant pages
3. Check "Footer Menu" under Menu Settings
4. Save the menu

## Step 5: Configure Theme Settings

1. Go to **Theme Settings** in the WordPress admin menu
2. Configure the following options:

### Header Settings:
- **Show Top Bar**: Toggle on/off
- **Opening Hours Text**: Set your business hours
- **Top Bar Links**: Add links for social media or other pages
- **Logo Image**: Upload your logo (400x100px recommended)
- **Quote Button Text**: Customize the button text (default: "get a quote")
- **Quote Button URL**: Set where the button links to

3. Click **Update** to save changes

## Step 6: Set Up Contact Form Email

The contact form sends emails to your WordPress admin email by default.

1. Go to **Settings → General**
2. Update the **Email Address** field to your business email
3. Make sure your server is configured to send emails (test the contact form)
4. Consider installing a plugin like "WP Mail SMTP" if emails aren't sending

## Step 7: Customize Content

### Update Contact Page Information
Edit `wp-content/themes/kingfact/page-contact.php` to update:
- Address
- Phone numbers
- Email addresses
- Business hours
- Social media links
- Google Maps embed URL

### Update Services
Edit `wp-content/themes/kingfact/page-services.php` to:
- Change service titles and descriptions
- Update service icons (using FontAwesome classes)
- Add or remove services (each is in a `col-lg-4` div)

### Update About Page
Edit `wp-content/themes/kingfact/page-about.php` to:
- Change company information
- Update profile, vision, mission content
- Modify "Why Us" sections
- Replace placeholder images

### Footer Customization
Edit `wp-content/themes/kingfact/footer.php` to:
- Update footer content
- Add widgets
- Change copyright information
- Add footer menu

## Step 8: Add Images

Upload images for:
1. **Logo**: Upload via Theme Settings
2. **Slide Backgrounds**: Upload via each Slide's Featured Image
3. **About Page Images**: Replace paths in page-about.php or use the Media Library
4. **Favicon**: Go to **Appearance → Customize → Site Identity**

## Step 9: Test Your Site

1. **Homepage**: Verify slides are displaying correctly
2. **Navigation**: Check all menu links work
3. **About Page**: Review content and layout
4. **Services Page**: Ensure all services display properly
5. **Contact Form**: Submit a test form and verify email delivery
6. **Mobile**: Check site responsiveness on mobile devices

## Step 10: Additional Recommendations

### Install Useful Plugins:
- **Yoast SEO** or **Rank Math**: For SEO optimization
- **WP Mail SMTP**: For reliable email delivery
- **Contact Form 7** or **WPForms**: Alternative form solutions
- **Wordfence Security**: Website security
- **UpdraftPlus**: Backup solution

### Customize Further:
1. Go to **Appearance → Customize** to adjust:
   - Site title and tagline
   - Colors (if supported)
   - Additional CSS for custom styling
   
2. Add blog posts if you want a blog section

3. Consider creating child theme for major customizations

## Theme File Structure

```
kingfact/
├── functions.php          # Theme functions and setup
├── header.php            # Site header
├── footer.php            # Site footer
├── front-page.php        # Homepage loader
├── page.php              # Default page template
├── page-home.php         # Homepage template
├── page-about.php        # About page template
├── page-services.php     # Services page template
├── page-contact.php      # Contact page template
├── style.css             # Main stylesheet
└── assets/               # CSS, JS, images, etc.
```

## Troubleshooting

### Slides not showing:
- Make sure you've created slides and published them
- Check that your homepage is using the "Home" template
- Verify Revolution Slider assets are in the assets folder

### Contact form not sending emails:
- Check WordPress Settings → General → Email Address
- Install and configure WP Mail SMTP plugin
- Contact your hosting provider about email sending capabilities

### Menu not displaying:
- Create a menu and assign it to "Primary Menu" location
- Check that header.php has the wp_nav_menu call

### ACF fields not showing:
- Make sure Advanced Custom Fields plugin is activated
- Visit Theme Settings to see if fields appear

## Support

For theme customization or issues:
1. Check WordPress Codex: https://codex.wordpress.org/
2. ACF Documentation: https://www.advancedcustomfields.com/resources/
3. Review theme files for inline comments

## Next Steps

After completing this setup:
1. Add your actual content to all pages
2. Upload real images and media
3. Configure additional plugins as needed
4. Test thoroughly before going live
5. Set up regular backups
6. Configure SEO settings

Your WordPress site is now ready to customize and launch!

## Helper: Edit Header Contact & Social Links

The theme exposes header contact information and social links via the **Theme Settings → Header Settings** options (ACF Options page). Use these steps to edit them:

1. In WP Admin go to **Theme Settings → Header Settings** (or visit /wp-admin/admin.php?page=theme-general-settings).
2. Edit the following fields:
   - **Contact Address** — address shown in the top header.
   - **Contact Email** — clickable email address.
   - **Contact Phone** — phone number shown in the top header.
   - **Social Links** — a repeater: add one row per social icon, set the **Icon Class** (FontAwesome class, e.g. `fab fa-facebook-f`) and the **URL**.
3. Click **Update** to save changes. The header will use these values with safe fallbacks if any field is empty.

Notes & Troubleshooting

- ACF Options Page: The theme registers an ACF Options page using `acf_add_options_page`. This requires ACF Pro to provide the admin UI for Options pages. If you only have the free ACF plugin the fields are defined but the Options page will not be visible.
  - If you do not have ACF Pro, either install ACF Pro or use the following alternatives:
    - Install a small plugin to add an Options page (e.g., "ACF Options Page" or "ACF Extended") that exposes the ACF option fields.
    - Ask me to add a simple fallback options page (no ACF) to the theme so values can be edited without ACF Pro.

- Icon Classes: The Social Links use FontAwesome classes. Enter the full class string (for example `fab fa-instagram`) in the Icon Class field.

- Quick test: after saving changes, reload the front page and verify contact text and social icons update immediately. If not visible, clear any caching and check the active theme is `kingfact`.

## Helper: Edit Footer Content

Footer content (logo, text, quick links, contact info and social icons) is editable from the Theme Settings options page.

How to edit:
1. Go to **Theme Settings → Footer Settings** (or visit /wp-admin/admin.php?page=theme-general-settings).
2. Edit the following fields:
   - **Footer Logo** — image used in the footer.
   - **Footer Text** — descriptive text or HTML (basic allowed).
   - **Quick Links** — repeater: add rows for each footer link (Link Text + URL).
   - **Contact Address / Email / Phone** — shown in the Contact Us block.
   - **Footer Social Links** — repeater: add one row per social link; set **Icon Class** (FontAwesome class, e.g. `fab fa-facebook-f`) and **URL**.
   - **Copyright Text** — editable copyright line.
3. Click **Update** to save changes. Changes appear immediately on the front-end (clear cache if necessary).

Notes & Troubleshooting

- ACF Options Page: The theme registers Fields as ACF option fields and uses `acf_add_options_page` to create the Theme Settings admin screen. This requires ACF Pro to display the Options page UI. If you only have the free ACF plugin, the fields will be registered but the Options page will not appear.
  - Alternatives if you don't have ACF Pro:
    - Install ACF Pro.
    - Install a plugin that provides an admin Options page compatible with ACF (e.g., "ACF Options Page" or ACF Extended).
    - Ask to add a simple fallback admin page (custom theme options) so editors can change values without ACF Pro.

- Icon Classes: Use FontAwesome class names in the Icon Class field (for example `fab fa-instagram`). Ensure FontAwesome is loaded by the theme (it is enqueued by default).
