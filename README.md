# TM Sponsor Carousel

![tm-sponsor rotation](https://github.com/heliogoodbye/TM-Sponsor-Carousel/assets/105381685/79b3606a-1122-48ec-abcf-d66cb0531f14)

**TM Sponsor Carousel** is a plugin to build and manage rotating carousels displaying sponsor logos on WordPress websites. It streamlines the process of showcasing logos of sponsors, partners, or supporters in an attractive and dynamic manner.

Key features of the plugin include:

- **Custom Post Type for Sponsor Logos:** The plugin introduces a custom post type specifically tailored for managing sponsor logos. This allows users to easily add, edit, and organize logos through the WordPress admin interface.

- **Meta Box for Logo Link URL:** Users can optionally assign a link URL to each sponsor logo. This feature enables visitors to click on a logo within the carousel and be directed to a specified webpage, enhancing interactivity and engagement.

- **Flexible Display Options:** The plugin provides a shortcode, `[tm_sponsor_carousel]`, that allows users to embed the sponsor logo carousel into any post, page, or widget area on their WordPress site. Users can also customize the number of logos displayed per page using the `posts_per_page` attribute.

- **Slick Carousel Integration:** The carousel functionality is powered by the Slick Carousel library, a popular JavaScript carousel solution known for its smooth animations and responsive design. This ensures a seamless user experience across various devices and screen sizes.

- **Styling Customization:** The plugin includes a CSS stylesheet `(tm-sponsor-carousel.css)` for basic styling of the carousel and logos. Users can modify these styles to match the branding and design aesthetics of their website.

Overall, the TM Sponsor Carousel plugin simplifies the process of managing and showcasing sponsor logos on WordPress websites, offering an intuitive interface and versatile display options for enhancing sponsor recognition and engagement.

---

## How to Use TM Sponsor Carousel

1. Installation
- Download the plugin files.
- Upload the plugin folder to the `/wp-content/plugins/` directory of your WordPress installation.
- Activate the plugin through the ‘Plugins’ menu in WordPress.

2. Adding Sponsor Logos
- After activating the plugin, you can add sponsor logos by navigating to *Sponsor Logos > Add New* in the WordPress admin panel.
- Enter a title for the sponsor logo.
- Set the featured image for the logo by clicking on “Set featured image” and uploading/selecting the image you want to use.
- Optionally, you can add a link URL for the logo by entering it in the “Logo Link” meta box.
- Click “Publish” to save the logo.

3. Displaying the Carousel
- To display the sponsor carousel on your site, you can use the `[tm_sponsor_carousel]` shortcode.
- You can add this shortcode to any post, page, or widget where you want the carousel to appear.
- Optionally, you can use the posts_per_page attribute to specify the number of logos to display per page. For example: `[tm_sponsor_carousel posts_per_page="10"]`

4. Styling Customization
- You can customize the appearance of the carousel and logos by modifying the CSS styles in the `tm-sponsor-carousel.css` file located in the plugin’s `css` directory.
- Adjust the styles according to your design requirements to match your website’s theme.

5. Further Customization:
- For advanced customization or additional functionality, you can modify the plugin code directly.
- Be cautious when editing plugin files to avoid breaking functionality or compatibility with future updates.
