<?php /* Template Name: Archived */ get_header(); ?>

	<main role="main" aria-label="Content">
		<!-- section -->
		<section>

			<!-- <h1><?php _e( 'Latest Posts', 'nudev' ); ?></h1> -->

			<?php get_template_part('loops/loop-archived'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
