<?php
/*

	Template Name: Submit A Story

*/

get_header();

?>

<main class="staticpage submitastory" role="main" aria-label="Content">
	<section>
		<article>
			<div id="contentarea" class="staticcontent">
				<div class="panel">
					<div class="contentarea">
						<h1>Submit a Story Idea</h1>

						<p>At Northeastern Magazine, we love to tell a good story. And you're our inspiration. Our accomplished alumni, faculty, and students make an impact on individuals, communities, and the world in many ways, small and large. But we need to hear from you. Please submit your idea by completing the form below.</p>

						<?=do_shortcode( '[wpforms id="128"]' );?>
					</div>
				</div>
			</div>
		</article>
	</section>
</main>
<?php get_footer(); ?>
