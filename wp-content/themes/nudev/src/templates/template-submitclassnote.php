<?php
/*

	Template Name: Submit A Class Note

*/

get_header();

?>

<main class="staticpage submitastory" role="main" aria-label="Content">
	<section>
		<article>
			<div id="contentarea" class="staticcontent">
				<div class="panel">
					<div class="contentarea">
						<h1>Submit A Class Note</h1>

						<p>Intro copy here</p>

						<?=do_shortcode( '[wpforms id="1458"]' );?>
					</div>
				</div>
			</div>
		</article>
	</section>
</main>
<?php get_footer(); ?>
