<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html__( 'All %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>
	
	<article>
		<header>
			<h3 class='text-center'><?php the_title();?></h3>
		</header>
		<!--div class="meta">
			<div class="row">
				<div class="col-lg-12">
					<time class="updated date" datetime="<?php the_time('c'); ?>"><?php echo tribe_events_event_schedule_details( $event_id ); ?></time>
					<span <?php post_class('type'); ?>><?php _e('Event'); ?></span>
					<div class="social">
						<?php if (function_exists('synved_social_share_markup')) echo synved_social_share_markup(); ?>
					</div>
         		</div>
        	</div>
    	</div-->
    	
		<hr>
		<div class='row'>
			<div class='col-sm-6'>
				<h4><i class='fa fa-calendar'></i>&nbsp;<?php echo tribe_events_event_schedule_details( $event_id ); ?></h4>
				<?php if ( tribe_get_cost() ) : ?>
				<h4><i class='fa fa-money'></i>&nbsp;Cost &nbsp; <span class='label label-default'><?php echo tribe_get_cost( null, true ) ?></span></h4><?php endif; ?>
		
				<a target='_blank' href="<?php echo tribe_get_single_ical_link();?>" class='btn btn-default'>+ ICAL EXPORT</a>
				<a target='_blank' href="<?php echo tribe_get_gcal_link();?>" class='btn btn-default'>+ GOOGLE CALENDAR</a>
				
			</div>
			<div class='col-sm-6'>	
				<?php tribe_get_template_part( 'modules/meta/venue' ); ?>
			</div>
		</div>		
		<hr>
		
		
		<div class='content'>
			<?php while ( have_posts() ) :  the_post(); ?>
				<!-- Event featured image, but exclude link -->
				<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
				
				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content">
					<?php the_content(); ?>
				</div>
				
				<?php if ( tribe_has_organizer() ) { tribe_get_template_part( 'modules/meta/organizer' );}?>
				
				<!-- Event meta -->
				<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
				
				<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
				<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
			<?php endwhile; ?>
		</div>
    </article>
	
	
	
	

	
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
