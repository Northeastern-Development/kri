<?php /* Template Name: Category */ get_header();

?>

	<main id="category" role="main" aria-label="Content">
		<section>
			<div class="articles">
				<?php //get_template_part('pagination'); ?>
				<?php get_template_part('loops/loop-category'); ?>
				<?php get_template_part('pagination'); ?>
			</div>
		</section>
		<!-- <section class="storyidea"> -->
			<?php get_template_part('includes/submitastory'); ?>
		<!-- </section> -->
	</main>

<?php get_footer(); ?>
