<?php
/*
Plugin Name: TM Sponsor Carousel
Description: Display a rotating carousel of sponsor logos.
Plugin URI: https://thinmint333.com/wp-plugins/tm-sponsor-carousel/
Version: 1.1
Author: Thin Mint
Author URI: https://thinmint333.com/
License: GPL-2.0
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// Register the custom post type for sponsor logos
function tm_sponsor_carousel_register_post_type() {
    $labels = array(
        'name'               => _x( 'Sponsor Logos', 'post type general name', 'tm_sponsor_carousel' ),
        'singular_name'      => _x( 'Sponsor Logo', 'post type singular name', 'tm_sponsor_carousel' ),
        'menu_name'          => _x( 'TM Sponsor Carousel', 'admin menu', 'tm_sponsor_carousel' ),
        'name_admin_bar'     => _x( 'Sponsor Logo', 'add new on admin bar', 'tm_sponsor_carousel' ),
        'add_new'            => _x( 'Add New', 'sponsor logo', 'tm_sponsor_carousel' ),
        'add_new_item'       => __( 'Add New Sponsor Logo', 'tm_sponsor_carousel' ),
        'new_item'           => __( 'New Sponsor Logo', 'tm_sponsor_carousel' ),
        'edit_item'          => __( 'Edit Sponsor Logo', 'tm_sponsor_carousel' ),
        'view_item'          => __( 'View Sponsor Logo', 'tm_sponsor_carousel' ),
        'all_items'          => __( 'All Sponsor Logos', 'tm_sponsor_carousel' ),
        'search_items'       => __( 'Search Sponsor Logos', 'tm_sponsor_carousel' ),
        'parent_item_colon'  => __( 'Parent Sponsor Logos:', 'tm_sponsor_carousel' ),
        'not_found'          => __( 'No sponsor logos found.', 'tm_sponsor_carousel' ),
        'not_found_in_trash' => __( 'No sponsor logos found in Trash.', 'tm_sponsor_carousel' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 23,
        'supports'           => array( 'title', 'thumbnail' ),
        'menu_icon'           => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyOC4zLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOiMwMTAxMDE7fQ0KPC9zdHlsZT4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xOC45LDQuMkMxNy41LDEuNywxNC44LDAsMTEuOCwwSDguMkMzLjcsMCwwLDMuOCwwLDguNGMwLDIuNCwxLDQuOSwxLjQsNS44YzIsMCw0LjEsMSw1LjItMC4yDQoJYzEuMywwLjUsMy4yLDEuNywzLjYsMy43Yy0wLjEsMC4xLTAuMSwwLjItMC4xLDAuNHYxYzAsMC41LDAuNCwwLjksMC44LDAuOXMwLjgtMC40LDAuOC0wLjl2LTFjMC0wLjEsMC0wLjMtMC4xLTAuNA0KCWMwLjItMy4zLDAuOC01LjcsMS4zLTdjMC42LTAuMSwxLjMtMC41LDEuOC0xQzE2LjIsOC40LDE4LjMsOC4zLDIwLDhDMjAsOCwxOS42LDUuNSwxOC45LDQuMnogTTUuMiwxMy4xYy0wLjMsMC0wLjUtMC4yLTAuNS0wLjUNCglzMC4yLTAuNSwwLjUtMC41YzAuMywwLDAuNSwwLjIsMC41LDAuNVM1LjQsMTMuMSw1LjIsMTMuMXogTTUuMSwxMC4ybDAuNC0zLjFMMi43LDUuOGwzLTAuNmwwLjMtMy4xbDEuNSwyLjdsMy0wLjZMOC41LDYuNUwxMCw5LjINCglMNy4yLDcuOUw1LjEsMTAuMnogTTEwLjYsMTUuMWMtMC45LTEuMi0yLjMtMS45LTMuMi0yLjRjMC0wLjEsMC4xLTAuMiwwLjEtMC40YzAuMy0xLjUsMS4zLTIuMiwyLjYtMi4yYzAuNCwwLDAuOCwwLjEsMS4yLDAuMw0KCWMwLjEsMC4xLDAuMiwwLjEsMC40LDAuMUMxMS4yLDExLjYsMTAuOCwxMy4xLDEwLjYsMTUuMXogTTEyLjcsOS4zYy0wLjMsMC0wLjUtMC4yLTAuNS0wLjVzMC4yLTAuNSwwLjUtMC41YzAuMywwLDAuNSwwLjIsMC41LDAuNQ0KCVMxMyw5LjMsMTIuNyw5LjN6Ii8+DQo8L3N2Zz4NCg==', // Add your SVG icon in base64 format here

    );

    register_post_type( 'tm_logo', $args );
}
add_action( 'init', 'tm_sponsor_carousel_register_post_type' );

// Add meta box for logo link URL
function tm_sponsor_carousel_meta_box() {
    add_meta_box( 'tm-logo-link', __( 'Logo Link', 'tm_sponsor_carousel' ), 'tm_sponsor_carousel_link_meta_box_callback', 'tm_logo', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'tm_sponsor_carousel_meta_box' );

// Callback function for logo link URL meta box
function tm_sponsor_carousel_link_meta_box_callback( $post ) {
    wp_nonce_field( 'tm_sponsor_carousel_link_meta_box', 'tm_sponsor_carousel_link_meta_box_nonce' );

    $value = get_post_meta( $post->ID, '_logo_link_url', true );

    echo '<label for="tm-logo-link-url">' . __( 'URL', 'tm_sponsor_carousel' ) . '</label>';
    echo '<input type="text" id="tm-logo-link-url" name="tm_logo_link_url" value="' . esc_attr( $value ) . '" style="width: 100%;">';
}

// Save the logo link URL
function tm_sponsor_carousel_save_link_url( $post_id ) {
    if ( ! isset( $_POST['tm_sponsor_carousel_link_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['tm_sponsor_carousel_link_meta_box_nonce'], 'tm_sponsor_carousel_link_meta_box' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['tm_logo_link_url'] ) ) {
        update_post_meta( $post_id, '_logo_link_url', sanitize_text_field( $_POST['tm_logo_link_url'] ) );
    }
}
add_action( 'save_post', 'tm_sponsor_carousel_save_link_url' );

// Shortcode for displaying the logo carousel
function tm_sponsor_carousel_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'posts_per_page' => -1,
    ), $atts, 'tm_sponsor_carousel' );

    $query_args = array(
        'post_type'      => 'tm_logo',
        'posts_per_page' => intval( $atts['posts_per_page'] ),
    );

    $logo_query = new WP_Query( $query_args );

    ob_start();
    if ( $logo_query->have_posts() ) : ?>
        <div class="tm_sponsor_carousel">
            <div class="slick-carousel">
                <?php while ( $logo_query->have_posts() ) : $logo_query->the_post(); ?>
                    <div class="logo-item">
                        <?php
                            $logo_link = get_post_meta( get_the_ID(), '_logo_link_url', true );
                            if ( $logo_link ) {
                                echo '<a href="' . esc_url( $logo_link ) . '">';
                            }
                            the_post_thumbnail();
                            if ( $logo_link ) {
                                echo '</a>';
                            }
                        ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif;
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'tm_sponsor_carousel', 'tm_sponsor_carousel_shortcode' );

// Enqueue necessary scripts and styles
function tm_sponsor_carousel_enqueue_scripts() {
    // Enqueue Slick Carousel styles
    wp_enqueue_style( 'slick-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
    wp_enqueue_style( 'slick-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' );

    // Enqueue your plugin's custom CSS stylesheet
    wp_enqueue_style( 'tm_sponsor_carousel-css', plugin_dir_url( __FILE__ ) . 'css/tm-sponsor-carousel-style.css', array(), null );
    
    // Enqueue Slick Carousel JavaScript
    wp_enqueue_script( 'slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array( 'jquery' ), null, true );
    
    // Enqueue your plugin's custom JavaScript file
    wp_enqueue_script( 'tm-sponsor-carousel-js', plugin_dir_url( __FILE__ ) . 'js/tm-sponsor-carousel.js', array( 'slick-carousel-js' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'tm_sponsor_carousel_enqueue_scripts' );
