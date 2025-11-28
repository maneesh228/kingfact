# Blog Management Guide - Kingfact Theme

## Overview
The blog functionality has been integrated into your WordPress site with a design matching the HTML template. All blog posts are managed through the WordPress admin panel.

## Managing Blog Posts

### Creating a New Blog Post

1. **Login to WordPress Admin**
   - Go to: `http://yourdomain.com/wp-admin`
   - Navigate to **Posts → Add New**

2. **Fill in the Post Details**

   - **Title**: Enter your blog post title (Required)
   - **Content**: Add your blog post content using the WordPress editor
   - **Featured Image**: 
     - Click "Set featured image" in the right sidebar
     - Upload or select an image
     - This image will appear in the blog listing and at the top of the single post
   - **Categories**: Assign categories to organize your posts
   - **Tags**: Add relevant tags for better organization
   - **Publish Date**: Can be scheduled for future publication

3. **Publish**
   - Click "Publish" to make the post live
   - Or click "Save Draft" to save without publishing

### Editing Blog Posts

1. Go to **Posts → All Posts**
2. Click on the post title or "Edit" link
3. Make your changes
4. Click "Update"

### Blog Fields Available

| Field | Description | Required |
|-------|-------------|----------|
| Title | Blog post headline | Yes |
| Content | Main blog post text/content | Yes |
| Featured Image | Main image for the post | Recommended |
| Date | Publication date | Auto-generated |
| Categories | Organize posts by topic | Optional |
| Tags | Keywords for the post | Optional |
| Author | Post author | Auto-assigned |
| Comments | Enable/disable comments | Optional |

## Viewing Your Blog

### Blog Archive Page
- **URL**: `http://yourdomain.com/blog/` or your posts page URL
- Displays all published blog posts in a 3-column grid layout
- Shows: Featured image, title, excerpt, date, and comment count
- Includes pagination for multiple pages

### Single Blog Post
- **URL**: `http://yourdomain.com/post-slug/`
- Displays full blog post with:
  - Featured image
  - Title
  - Author, date, categories
  - Full content
  - Tags
  - Social share buttons
  - Author bio
  - Previous/Next post navigation
  - Comments section
  - Sidebar with search, categories, recent posts, and tags

### Blog Categories
- **URL**: `http://yourdomain.com/category/category-name/`
- Shows all posts in a specific category

### Blog Tags
- **URL**: `http://yourdomain.com/tag/tag-name/`
- Shows all posts with a specific tag

## Setting Up the Blog Page

### Option 1: Using WordPress Reading Settings
1. Go to **Settings → Reading**
2. Set "Your homepage displays" to "A static page"
3. Choose your homepage for "Homepage"
4. Choose a page for "Posts page" (create a blank page called "Blog" first)
5. Save changes

### Option 2: Create a Menu Link
1. Go to **Appearance → Menus**
2. Add "Blog" or "Posts page" to your menu
3. The blog will be accessible from the menu

## Customization Options

### Blog Breadcrumb Background
If you have ACF (Advanced Custom Fields) installed:
1. Go to **Theme Options** (or similar ACF options page)
2. Find "Blog Settings"
3. Upload a custom breadcrumb background image
4. Default image: `/assets/img/bg/bg-9.jpg`

### Comments Settings
1. Go to **Settings → Discussion**
2. Configure comment settings:
   - Enable/disable comments
   - Require name and email
   - Comment moderation options
   - Email notifications

### Sidebar Widgets (Future Enhancement)
Currently using default WordPress widgets. Can be customized via:
- **Appearance → Widgets** (when widget areas are registered)

## File Structure

### Theme Files
```
wp-content/themes/kingfact/
├── home.php              # Main blog listing (posts page)
├── archive.php           # Category/tag archives
├── single.php            # Single blog post
├── comments.php          # Comments template
├── style.css             # Blog styling
└── functions.php         # Blog functionality
```

### Template Hierarchy
WordPress uses this order to display blog content:
1. **Blog listing**: `home.php` → `index.php`
2. **Single post**: `single.php` → `singular.php` → `index.php`
3. **Categories**: `category.php` → `archive.php` → `index.php`
4. **Tags**: `tag.php` → `archive.php` → `index.php`

## Tips & Best Practices

### Images
- **Recommended size**: 800x600px or larger
- **Format**: JPG or PNG
- Always add alt text for SEO
- Compress images before uploading

### SEO
- Use descriptive titles (50-60 characters)
- Write compelling excerpts
- Use categories and tags strategically
- Add internal links to other posts

### Writing
- Break content into short paragraphs
- Use headings (H2, H3) for structure
- Include images throughout long posts
- Add a clear call-to-action

### Performance
- Don't upload huge images (optimize first)
- Limit the number of categories/tags
- Use caching plugins

## Common Tasks

### Delete a Post
1. **Posts → All Posts**
2. Hover over post → Click "Trash"
3. Permanently delete from Trash if needed

### Bulk Actions
1. **Posts → All Posts**
2. Check boxes next to multiple posts
3. Select action from "Bulk Actions" dropdown
4. Click "Apply"

### Manage Categories
1. **Posts → Categories**
2. Add new categories or edit existing ones
3. You can set parent categories for hierarchy

### Manage Tags
1. **Posts → Tags**
2. Add or remove tags
3. Tags are non-hierarchical

## Troubleshooting

### Blog page showing 404
- Go to **Settings → Permalinks**
- Click "Save Changes" (don't change anything)
- This refreshes the permalink structure

### Images not showing
- Check file permissions on uploads folder
- Verify image was properly uploaded
- Check theme assets path

### Styling issues
- Clear browser cache
- Check if CSS files are loading
- Verify theme is active

### Comments not working
- Check **Settings → Discussion**
- Ensure comments are enabled for the post
- Check spam folder for moderation

## Support

For additional help:
- WordPress Codex: https://codex.wordpress.org/
- WordPress Support: https://wordpress.org/support/
- Theme Documentation: Check theme files

## Next Steps

Consider adding:
1. **Related Posts** - Show similar posts at the end of articles
2. **Email Subscription** - Newsletter signup forms
3. **Social Share** - Enhanced social sharing plugins
4. **SEO Plugin** - Yoast SEO or Rank Math
5. **Analytics** - Google Analytics integration
