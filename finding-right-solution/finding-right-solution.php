<?php
/***
 * Plugin Name: Finding Right Solution
 */

/***
 * Register Finding Right Solution Post Type
 */
function register_finding_right_solution() {
    $labels = array(
        'name' => 'Finding Right Solution',
        'singular_name' => 'FRS',
        'add_new' => 'Add New',
        'all_items' => 'All Requests',
        'add_new_item' => 'Add New',
        'edit_item' => 'Edit Request',
        'new_item' => 'New Request',
        'view_item' => 'View Request',
        'search_item' => 'Search Request',
        'not_found' => 'No request found',
        'not_found_in_trash' => 'No request found in trash',
        'parent_item_colon' => 'Parent Request',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-book',
        'has_archive' => 'Finding Right Solution',
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'Finding Right Solution'],
        'capability_typ' => 'post',
        'hierarchical' => false,
        'supports' => array('title'),
        'taxonomies' => array(),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('wp_ftr', $args);
}
add_action( 'init', 'register_finding_right_solution');


/***
 * Finding Right Solution Request Saving
 */

// process all wp_ajax_* calls
add_action( 'init', 'core_add_ajax_hook' );
function core_add_ajax_hook() {
    /* Theme only, we already have the wp_ajax_ hook firing in wp-admin */
    if ( ! defined( 'WP_ADMIN' ) && isset( $_REQUEST['action'] ) ) {
        do_action( 'wp_ajax_' . $_REQUEST['action'] );
    }
}

/***
 * Make ajaxurl variable available in javascript
 */
add_action('wp_head', 'frs_ajaxurl');
function frs_ajaxurl() {
    echo '<script type="text/javascript"> let ajaxurl = "' . admin_url('admin-ajax.php') . '"; </script>';
}


/***
 *  Save FRS (Finding Right Solution) Post
 */
add_action( 'wp_ajax_create_frs_post', 'wp_ajax_create_frs_post_callback_function' );
function wp_ajax_create_frs_post_callback_function() {
    // use the $_POST to create your post
    $args = array(
        'post_type' => 'wp_ftr',
        'post_status' => 'publish',
        'post_title' => isset( $_POST['title'] )? $_POST['title'] : '',
    );
    $post_id = wp_insert_post( $args );

    // save post meta fields
    if ( isset( $_POST['email'] ) ) {
        update_field(  'email', $_POST['email'], $post_id);
    }

    if ( isset( $_POST['company'] ) ) {
        update_field('company', $_POST['company'], $post_id);
    }

    if ( isset( $_POST['telephone'] ) ) {
        update_field( 'telephone', $_POST['telephone'], $post_id);
    }

    if ( isset( $_POST['organization_sector'] ) ) {
        update_field('organization_sector', $_POST['organization_sector'], $post_id);
    }

    if ( isset( $_POST['learning_challenge'] ) ) {
        $learning_challenge = implode(',', $_POST['learning_challenge']);
        update_field( 'learning_challenge', $learning_challenge, $post_id);
    }

    if ( isset( $_POST['describe_audience'] ) ) {
        update_field( 'describe_audience', $_POST['describe_audience'], $post_id);
    }

    if ( isset( $_POST['no_of_participants'] ) ) {
        update_field('no_of_participants', $_POST['no_of_participants'], $post_id);
    }

    if ( isset( $_POST['charge_courses'] ) ) {
        update_field('charge_courses', $_POST['charge_courses'], $post_id);
    }

    /***
     * Generate Email
     */
    generate_email_frs($post_id);

    // make a response
    $response = array( 'post_id' => $post_id, 'message' => 'post created!' );

    // set the content type and return json encode response, then exit
    header( 'Content-type: application/json' );
    die( json_encode( $response ) );
}


/***
 * Configure Mail Service
 */
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username   = SMTP_USERNAME;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;
}

/***
 * Generate Email Request
 * @param $post_id
 */
function generate_email_frs($post_id){
    $to = "hello@edly.io";
    $subject = "Finding Right Solution Request";
    $message = "<html>
        <section class=\"content-section\">
            <div class=\"container\">
                <h3>Finding Right Solution Request Details</h3>
                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <div>
                            <span><strong>Full Name : </strong>".get_the_title(get_post($post_id))."</span>
                        </div>
                        <div>
                            <span><strong>Email : </strong>".get_field('email', $post_id) ."</span>
                        </div>
                        <div>
                            <span><strong>Telephone : </strong>".get_field('telephone', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>Company : </strong>".get_field('company', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>Organization Sector : </strong>".get_field('organization_sector', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>Describe Audience : </strong>".get_field('describe_audience', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>Top Learning Challenges : </strong>".get_field('learning_challenge', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>No Of Participants : </strong>".get_field('no_of_participants', $post_id)."</span>
                        </div>
                        <div>
                            <span><strong>Charge For Courses : </strong>".get_field('charge_courses', $post_id)."</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </html>";
    $headers = array("Content-Type: text/html; charset=UTF-8");
    wp_mail( $to, $subject, $message, $headers );
}

