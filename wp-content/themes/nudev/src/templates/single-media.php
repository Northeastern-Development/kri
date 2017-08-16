<?php
	/*

		Template Name: Multi-media
		Template Post Type: post

	*/

	// grab the header
	get_header();

	// grab the post details
	the_post();

	// get the author information
	$bioBlock = "";
	if(get_field('select_author')){
		$obj = get_field('select_author');
		$post = $obj;
		setup_postdata($post);
		$author['name'] = get_field('author_name');
		$author['sbio'] = get_field('short_bio');
		wp_reset_postdata();

		$bioBlock = '<div id="authorbio">'.trim($author['sbio']).'</div>';
	}

	// get the rubrick
	$rubrick = get_field('rubrick');

	// get the header area content
	$header = get_field('header_area')[0];
	$postHeader = "";

	$guide = '<div id="title"><span class="rubrick">%s</span>%s%s%s</div>';

	$postHeader = sprintf(
		 $guide
		,ucwords($rubrick->name)
		,'<h1>'.trim($header['primary_title']).'</h1>'
		,($header['secondary_title']?'<h2>'.trim($header['secondary_title']).'</h2>':'')
		,(isset($author['name'])?'<div class="tick" style="color: '.$header['color'].'; background: '.$header['color'].';"></div><span class="authorname" style="color: '.$header['color'].';">By '.ucwords(trim($author['name'])).'<span>':'')
	);


	// build out the content to be shown
	$content = "";

	// print_r(get_field('single_image'));
	// die();

	switch (strtolower(get_field('type'))){
		case "single image":
			$content .= '<img src="'.get_field('single_image')[0]['image']['url'].'" alt="'.get_field('single_image')[0]['caption'].'" /><span class="caption">'.(get_field('single_image')[0]['caption']?get_field('single_image')[0]['caption'].(get_field('single_image')[0]['photo_credit'] != ""?", ".get_field('single_image')[0]['photo_credit']:""):"").'</span>';
			break;
		case "single video":
			$content .= get_field('single_video')[0]['single_video'];
			break;
		case "media gallery":
			$mediaItems = get_field('gallery');
			$content .= '<ul class="gallery">';
			foreach($mediaItems as $mI){
				$content .= '<li><a class="'.(strpos($mI['description'],"vimeo") > 0 || strpos($mI['description'],"youtube") > 0?"mfp-iframe":"mfp-image").'" href="'.(strpos($mI['description'],"vimeo") > 0 || strpos($mI['description'],"youtube") > 0?$mI['description']:$mI['url']).'" title="Click to view image" data-title="'.$mI['caption'].'"><img src="'.$mI['sizes']['thumbnail'].'" alt="'.$mI['caption'].'" /></a></li>';
			}
			$content .= '</ul>';
			break;
		default:
			$content .= 'Unable to load content';
			break;
	}

	// do we have a copy block to show?  And should it be above or below the media?
	if(get_field('copy_block')){
		if(strtolower(get_field('copy_block')[0]['position']) == "above"){
			$content = '<div class="above">'.get_field('copy_block')[0]['copy_block'].'</div>'.$content;
		}else{
			$content = $content.'<div class="below">'.get_field('copy_block')[0]['copy_block'].'</div>';
		}
	}
?>

<main class="single-media" role="main" aria-label="Content">
	<section>
		<article id="post-<?php the_ID(); ?>" class="<?=str_replace(" ","",strtolower(get_field('color_scheme')))?>  <?php $classes = get_post_class(); foreach($classes as $cL){echo $cL." ";}?>">
			<div class="title inline">
				<?=$postHeader?>
			</div>
			<div id="contentarea" class="multimedia">
				<div class="panel">
					<div class="contentarea">
						<div id="sharepanel">
							<a href="http://www.facebook.com/share.php?u=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>" title="Share this on Facebook" target="_blank">&#xf09a;</a>
							<a href="http://twitter.com/intent/tweet?original_referer=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>&amp;text=Northeastern University Magazine - <?=trim(get_field('title_panel')[0]['primary_title'])?>&amp;url=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>" title="Share this on Twitter" target="_blank">&#xf099;</a>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>&amp;title=Northeastern University Magazine -<?=trim(get_field('title_panel')[0]['primary_title'])?>&amp;summary=Northeastern University Magazine - <?=(get_field('title_panel')[0]['primary_title'])?>&amp;source=Northeastern University Magazine" title="Share this on Linkedin" target="_blank">&#xf0e1;</a>
							<a href="mailto:person@email.com?subject=Northeastern University Magazine - <?=trim(get_field('title_panel')[0]['primary_title'])?>&body=I thought that you might find this article interesting: <?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>" title="Share this via email" >&#xf064;</a>
						</div>
						<?=$content?>
						<?=$bioBlock?>
						<div id="posttags">Tagged in:
						<?php
							$tags = get_the_tags();
							$showTags = "";
							foreach($tags as $t){
								$showTags .= ($showTags != ""?", ":"").'<a href="'.home_url().'/?s='.$t->name.'" title="search for articles tagged with '.$t->name.'">'.strtolower($t->name).'</a>';
							}
							echo $showTags;
						?>
						</div>
						<?php get_template_part('includes/submitastory'); ?>
					</div>
				</div>
				<?php get_footer(); ?>
			</div>
		</article>
	</section>
</main>
