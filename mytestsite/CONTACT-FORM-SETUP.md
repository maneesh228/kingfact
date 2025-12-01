# Contact Form 7 Integration Guide

## ✅ What's Been Done

1. **Plugin Installation**: Contact Form 7 plugin is installed and active
2. **Theme Integration**: Contact page now uses Contact Form 7 instead of custom form
3. **Custom Styling**: Added CSS to match your theme's design
4. **Auto-Setup**: Created setup file that automatically creates a contact form

## 📧 Where to See Contact Enquiries

**Location**: WordPress Admin → Contact → Contact Forms

### Viewing Submissions:
1. Go to **WordPress Admin Dashboard**
2. Navigate to **Contact** in the left sidebar
3. Click on your form name (e.g., "Contact Form - Kingfact Theme")
4. Click on the **"Submissions"** or **"Flamingo"** menu (if Flamingo plugin is installed)

### Install Flamingo Plugin (Recommended):
Contact Form 7 doesn't store submissions by default. Install **Flamingo** plugin to save all form submissions:

```
WordPress Admin → Plugins → Add New → Search "Flamingo" → Install & Activate
```

After activating Flamingo:
- View submissions: **Flamingo → Inbound Messages**
- Export to CSV: Available in Flamingo
- Email notifications: Still sent as before

## 🎨 Form Customization

### Edit Form Fields:
1. Go to **Contact → Contact Forms**
2. Click on your form name
3. Edit the **Form** tab with Contact Form 7 tags

### Current Form Fields:
- **Name** (required): `[text* your-name]`
- **Email** (required): `[email* your-email]`
- **Website** (optional): `[url your-website]`
- **Message** (required): `[textarea* your-message]`

### Email Settings:
- **Mail** tab: Configure where submissions are sent
- **Mail (2)** tab: Auto-reply email to users
- Default: Sends to your admin email address

## 🎯 Features

### What You Get:
✅ **Database Storage** (with Flamingo plugin)
✅ **Email Notifications** to admin
✅ **Auto-Reply** to users
✅ **Spam Protection** (built-in)
✅ **Form Validation**
✅ **Export Submissions** (with Flamingo)
✅ **AJAX Submission** (no page reload)
✅ **Mobile Responsive**
✅ **Theme Styled** (matches Kingfact design)

### Success/Error Messages:
Form shows colored messages after submission:
- 🟢 Green: Success
- 🔴 Red: Error/Validation failed
- 🟡 Yellow: Spam detected

## 🛠️ Common Customizations

### Add Phone Field:
1. Edit your form in Contact → Contact Forms
2. Add this in the Form tab:
```
<div class="col-md-4">
    <div class="contacts-icon contactss-phone">
        [tel your-phone placeholder "Your Phone...."]
    </div>
</div>
```

### Make Field Required:
Add an asterisk (*) after field type:
- `[text your-name]` → `[text* your-name]`
- `[tel your-phone]` → `[tel* your-phone]`

### Change Placeholder Text:
```
[text* your-name placeholder "Enter your name here"]
```

### Add Dropdown/Select Field:
```
<div class="col-md-12">
    [select your-subject "General Inquiry" "Quote Request" "Support" "Other"]
</div>
```

### Add File Upload:
```
<div class="col-md-12">
    [file your-file limit:2mb filetypes:jpg|png|pdf]
</div>
```

## 📬 Email Configuration

### Change Recipient Email:
1. Contact → Contact Forms → Your Form
2. Click **Mail** tab
3. Change **To:** field to your desired email

### Configure Auto-Reply:
1. Go to **Mail (2)** tab
2. Check "Use Mail (2)"
3. Customize subject and message
4. **From:** will be your site name

### Add CC/BCC:
In the **Mail** tab, add:
```
Cc: email@example.com
Bcc: another@example.com
```

## 🔧 Troubleshooting

### Form Not Showing:
1. Make sure Contact Form 7 plugin is active
2. Check that form ID exists (Contact → Contact Forms)
3. Clear browser cache

### Emails Not Sending:
1. Test with WP Mail SMTP plugin
2. Check spam folder
3. Verify admin email in Settings → General
4. Test with simple "To:" address like Gmail

### Styling Issues:
Custom CSS is in: `assets/css/main.css` (lines 5480+)
- Modify colors, spacing, etc. there
- Main theme color: `#febc35` (yellow)
- Dark color: `#1b1b1b`

### Submissions Not Saving:
- Install **Flamingo** plugin
- All future submissions will be saved automatically

## 📊 Export Submissions

With Flamingo installed:
1. Go to **Flamingo → Inbound Messages**
2. Select messages you want to export
3. Use **Bulk Actions → Export** (if available)
4. Or use export plugin like "Export All Data"

## 🔐 Spam Protection

Contact Form 7 includes:
- **CAPTCHA** support (add reCAPTCHA)
- **Akismet** integration
- **Honeypot** technique

To add reCAPTCHA:
1. Get keys from Google reCAPTCHA
2. Go to Contact → Integration
3. Add reCAPTCHA keys
4. Add `[recaptcha]` tag to your form

## 📱 Form is Mobile Responsive

The form automatically adjusts on mobile devices:
- 3 columns → 1 column on phones
- Touch-friendly inputs
- Optimized button size

## 🎨 Theme Colors

Current styling uses:
- **Primary**: `#febc35` (yellow hover)
- **Dark**: `#1b1b1b` (button background)
- **Border**: `#eaeaea` (input borders)
- **Success**: `#398f14` (green)
- **Error**: `#dc3545` (red)

## Files Modified

1. **page-contact.php** - Replaced custom form with CF7 shortcode
2. **assets/css/main.css** - Added CF7 styling
3. **inc/setup-contact-form.php** - Auto-creates contact form (new file)
4. **functions.php** - Includes setup file

## Need Help?

- Contact Form 7 Docs: https://contactform7.com/docs/
- Flamingo Plugin: https://wordpress.org/plugins/flamingo/
- Theme Support: Check your theme documentation
