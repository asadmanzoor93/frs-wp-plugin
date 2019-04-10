<?php
/**
 * Template Name: Features
 *
 * @package WordPress
 * @subpackage Edly
 * @since Edly
 */
?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- Description -->
    <section id="description" class="content-section">
        <div class="container">
           <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <?php the_content(); ?>
                </div>
           </div>
        </div>
    </section>

<?php endwhile; ?>


<!-- Features holder -->

<section id="features-holder"  class="content-section">
    <div class="container">
        <div class="row">

        <?php
        // check if the repeater field has rows of data
        
        if( have_rows('feature') ):
            $counter =1;
            // loop through the rows of data
            while ( have_rows('feature') ) : the_row();

            // display a sub field value
            $title = get_sub_field('feature_title');
            $content = get_sub_field('feature_description');
            $icon = get_sub_field('feature_icon');
            
            ?>
            <div class="col-md-4">
                <div class="feature">
                    <div class="feature-icon"><img src="<?php echo $icon ?>"></div>
                    <div class="content">
                        <h3 class="feature-title"><?php echo $title ?></h3>
                        <div class="feature-content"><?php echo $content ?></div>
                    </div>
                </div>
            </div>
    
            <?php
                $counter++;
            endwhile;
            
            else :
                
                // no rows found
                
            endif;
            ?>

        </div>
    </div>
</section>

<!-- Right Solution -->


<section id="right-solution" class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 card">
                <div class="solution-content">

                    <div class="content">
                        <h3>Not sure which solution is right for you?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                
                    <button class="button"  data-toggle="modal" data-target="#myModal">Let's go</button>
                </div>

                <div class="image-holder">
                    <img src="<?php bloginfo('template_directory'); ?>/images/image.jpg">
                </div>

            </div>
        </div>
    </div>
</section>



<!-- Testimonials -->

<section id="testimonails" class="content-section">
    <h2 class="section-heading">What our customers say</h2>
    <div class="container">
        <div class="row card">
            <div class="col-md-12">
                
 <?php $args = array('post_type' => 'testimonial', 'posts_per_page' => 30);
                $loop = new WP_Query($args);
                $count = 1;
                while ($loop->have_posts()) : $loop->the_post(); ?>

                <div class="image-holder">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="testimonial-content">
                    <div class="content">
                        <?php the_field('testimonial_content') ?> 
                    </div>
                    <div class="person"><?php the_field('person_name') ?></div>
                    <div class="company"><?php the_field('company_name') ?></div>
                    <!--<a href="#" class="see-all">SEE OUR CASE STUDIES</a>-->
                </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<!-- Step Builder -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!-- <div class="modal-backdrop fade in"></div> -->
    <div class="modal-dialog">
        <div class="first-step">
            <div class="content-block">
                <div class="icon-holder">
                    <img src="<?php bloginfo('template_directory'); ?>/images/finder.svg">
                </div>
                <h3>Find the right solution for you</h3>
                <p>Edly works with a diverse range of organizations, universities, schools and non-profits. Basically, anyone who could benefit from harnessing the power of learning. With our expert status in the world of tech-based learning, and our many note-worthy existing partners, we are the absolute premier providing of online learning systems that work. To find out how we can help your enterprise, contact us below to request a demo.</p>
            </div>
            <button type="button" class="button start">LET'S START</button>
        </div>
        <div class="last-step">
            <div class="content-block">
                <div class="img-holder">
                    <img src="<?php bloginfo('template_directory'); ?>/images/img-banner.jpg">
                </div>
                <h3>Thank you</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <a href="#">Back to solutions</a>
            </div>
            <button type="button" class="button last" data-orientation="cancel" data-dismiss="modal">LET'S GO</button>
        </div>
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn btn-default js-btn-step pull-left btn-close" data-orientation="cancel" data-dismiss="modal"><img src="<?php bloginfo('template_directory'); ?>/images/close.png"></button>
        </div>
        <div class="modal-body">
            <div class="row hide" data-step="1" data-title="This is the first step!">
                <div class="content-block">
                    <div class="icon-holder">
                        <img src="<?php bloginfo('template_directory'); ?>/images/question.svg">
                    </div>
                    <h3>What sector is your organisation within?</h3>
                    <select id="organization_sector" required>
                        <option hidden>Select your organization sector</option>
                        <option value="sector 1">sector 1</option>
                        <option value="sector 2">sector 2</option>
                        <option value="sector 3">sector 3</option>
                        <option value="sector 4">sector 4</option>
                    </select>
                </div>
            </div>

             <div class="row hide" data-step="2" data-title="This is the second step!">
                <div class="content-block">
                    <div class="icon-holder">
                        <img src="<?php bloginfo('template_directory'); ?>/images/audience.svg">
                    </div>
                    <h3>What best describes your intended audience?</h3>
                    <select id="describe_audience" required>
                        <option hidden>Select your preference</option>
                        <option value="option 1">option 1</option>
                        <option value="option 2">option 2</option>
                        <option value="option 3">option 3</option>
                        <option value="option 4">option 4</option>
                    </select>
                </div>
            </div>

             <div class="row hide" data-step="3" data-title="This is the third step!">
                <div class="content-block">
                    <div class="icon-holder">
                        <img src="<?php bloginfo('template_directory'); ?>/images/training.svg">
                    </div>
                    <h3>What are your top learning challenges?</h3>
                    <div class="checkboxes-holder">
                        <div class="checkboxes">
                            <input type="checkbox" id="check01" name="learning_challenge[]" value="Challenge 1" />
                            <label for="check01"><span>Challenge 1</span></label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check02" name="learning_challenge[]" value="Challenge 2" />
                            <label for="check02"><span>Challenge 2</span></label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check03" name="learning_challenge[]" value="Challenge 3" />
                            <label for="check03"><span>Challenge 3</span></label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check04" name="learning_challenge[]" value="Challenge 4" />
                            <label for="check04"><span>Challenge 4</span></label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check05" name="learning_challenge[]" value="Challenge 5" />
                            <label for="check05"><span>Challenge 5</span></label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check06" name="learning_challenge[]" value="Challenge 6" />
                            <label for="check06"><span>Challenge 6</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hide" data-step="4" data-title="This is the fourth step!">
                <div class="content-block">
                    <div class="icon-holder">
                        <img src="<?php bloginfo('template_directory'); ?>/images/participants.svg">
                    </div>
                    <h3>What is the intended number of participants?</h3>
                    <input type="text" class="participants" id="no_of_participants" placeholder="eg. 500">
                </div>
            </div>

            <div class="row hide" data-step="5" data-title="This is the fifth step!">
                <div class="content-block">
                    <div class="icon-holder">
                        <img src="<?php bloginfo('template_directory'); ?>/images/money.svg">
                    </div>
                    <h3>Do you intend to charge money for courses on the platform?</h3>
                    <div class="options">
                        <div class="radio-buttons">
                            <input type="radio" id="yes" value="Yes" name="charge_courses">
                            <label for="yes">Yes</label>
                        </div>
                        <div class="radio-buttons">
                            <input type="radio" id="no" value="No" name="charge_courses">
                            <label for="no">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row hide" data-step="6" data-title="This is the sixth step!">
                <div class="content-block">
                    <div class="form-step">
                        <span class="title">Your details</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="field">
                                    <label for="title">Full Name</label>
                                    <span class="info">We will require your name</span>
                                    <input type="text" id="title" placeholder="">
                                </div>
                                <div class="field">
                                    <label for="email">Email</label>
                                    <span class="info">We will require your email address</span>
                                    <input type="email" id="email" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="field">
                                    <label for="company">Company</label>
                                    <span class="info">We will require your company name</span>
                                    <input type="text" id="company" placeholder="">
                                </div>
                                <div class="field">
                                    <label for="telephone">Telephone</label>
                                    <span class="info">We will require your phone number</span>
                                    <input type="tel" id="telephone" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox" id="check20" name="check" />
                            <label for="check20"><span>Lorem ipsum dolor sit amet, consectetur adipiscing </span></label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="button js-btn-step previous" data-orientation="previous"></button>
            <button type="button" class="button js-btn-step" data-orientation="next"></button>
        </div>
        <nav class="form-pagination">
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
            </ul>
        </nav>
        </div>
    </div>
</div>


<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>

<script>
    jQuery('#myModal').modalSteps();

    function create_frs_request(){
        let organization_sector = jQuery('#organization_sector').val();
        let describe_audience = jQuery('#describe_audience').val();
        let no_of_participants = jQuery('#no_of_participants').val();
        let charge_courses = jQuery('input[name="charge_courses"]:checked').val();

        let learning_challenge = jQuery('input:checked[name="learning_challenge[]"]')
                                        .map(function () { return jQuery(this).val(); }).get();

        let title = jQuery('#title').val();
        let email = jQuery('#email').val();
        let company = jQuery('#company').val();
        let telephone = jQuery('#telephone').val();

        let data = {
            action: 'create_frs_post',
            title: title,
            email: email,
            company: company,
            telephone: telephone,
            organization_sector: organization_sector,
            describe_audience: describe_audience,
            learning_challenge: learning_challenge,
            no_of_participants: no_of_participants,
            charge_courses: charge_courses,
        };

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success : function( response ) {
                console.log( response );
            },
            fail : function( response ) {
                console.log( response );
            }
        });
    }

</script>