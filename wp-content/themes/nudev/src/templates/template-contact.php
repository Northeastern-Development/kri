<?php
/*

	Template Name: Contact

*/

get_header();

?>

	<main class="staticpage" role="main" aria-label="Content">
		<section>
			<article>
				<div id="contentarea" class="staticcontent">
					<div class="panel">
						<div class="contentarea contact">

							<h1>Contact Us</h1>

							<p>We'd love to hear from you.  Please submit comments and feedback using this form.</p>

							<?=do_shortcode( '[wpforms id="1138"]' );?>
						</div>
					</div>
					<div class="panel">
						<div class="contentarea">
							<h2>Mailing Address</h2>
							<p>
								Northeastern Magazine<br />
								<a href="https://www.google.com/maps/place/716+Columbus+Ave,+Boston,+MA+02120/@42.3321879,-71.0794901,15z/data=!4m5!3m4!1s0x89e37a3d54c27e69:0xfa22f46abf8b9df9!8m2!3d42.3377196!4d-71.085304" title="716 Columbus Ave. Boston, MA 02120" target="_blank">716 Columbus Ave., 598CP<br />
								Boston, MA 02120</a><br />
							</p>
						</div>
					</div>
				</div>
			</article>
		</section>
	</main>
	<?php get_footer(); ?>
