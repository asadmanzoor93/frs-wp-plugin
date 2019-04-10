<?php

/**
 * The Template for displaying all posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <section class="content-section">
        <div class="container">
            <h3>Finding Right Solution Request Details</h3>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <span><strong>Full Name : </strong><?php the_title() ?></span>
                    </div>
                    <div>
                        <span><strong>Email : </strong><?php the_field('email') ?></span>
                    </div>
                    <div>
                        <span><strong>Telephone : </strong><?php the_field('telephone') ?></span>
                    </div>
                    <div>
                        <span><strong>Company : </strong><?php the_field('company') ?></span>
                    </div>
                    <div>
                        <span><strong>Organization Sector : </strong><?php the_field('organization_sector') ?></span>
                    </div>
                    <div>
                        <span><strong>Describe Audience : </strong><?php the_field('describe_audience') ?></span>
                    </div>
                    <div>
                        <span><strong>Top Learning Challenges : </strong><?php the_field('learning_challenge') ?></span>
                    </div>
                    <div>
                        <span><strong>No Of Participants : </strong><?php the_field('no_of_participants') ?></span>
                    </div>
                    <div>
                        <span><strong>Charge For Courses : </strong><?php the_field('charge_courses') ?></span>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>