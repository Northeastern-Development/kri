<?php /* Template Name: Homepage */ get_header(); ?>

	<main id="homepage" role="main" aria-label="Content">

		<section class="featured">
			<div class="overlap"></div>
			<div class="articles">
				<?php get_template_part('loops/loop-featured'); ?>
			</div>
		</section>

		<section class="trending">
			<div class="category-misc">
				<p class="underlineheader">Editors' Picks</p>
			</div>
			<?php get_template_part('loops/loop-picks'); ?>
		</section>

		<section class="recent">
			<div class="overlap"></div>
			<div class="articles">
				<?php get_template_part('loops/loop-recent'); ?>
			</div>
		</section>

		<!-- <section class="storyidea"> -->
			<?php get_template_part('includes/submitastory'); ?>
		<!-- </section> -->

	</main>
<?php get_footer(); ?>
