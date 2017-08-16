<?php
	/*

		Template Name: Editorial
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
	$guide = '<div id="title" class="%s"><span class="rubrick" style="color: '.$header['color'].'; border: solid '.$header['color'].' 1px;">%s</span>%s%s%s<br /></div><img src="%s" alt="%s" />';

	$postHeader = sprintf(
		 $guide
		,strtolower($header['title_position']['value'])
		,ucwords($rubrick->name)
		,'<h1 style="color: '.$header['color'].';">'.trim($header['primary_title']).'</h1>'
		,($header['secondary_title']?'<h2 style="color: '.$header['color'].';">'.trim($header['secondary_title']).'</h2>':'')
		,(isset($author['name'])?'<div class="tick" style="color: '.$header['color'].'; background: '.$header['color'].';"></div><span class="authorname" style="color: '.$header['color'].';">By '.ucwords(trim($author['name'])).'<span>':'')
		,$header['image']['url']
		,$header['caption']
	);

	// build out the content to be shown on the page
	$content = "";
	$cnt = 0;
	foreach(get_field('article_content') as $panel){

		if($cnt == 0){
			$content .= '<p class="caption">';
			if($header['caption'] != ""){
				$content .= $header['caption'];
			}
			if($header['photo_credit'] != ""){
				$content .= ($header['caption'] != ""?", ":"").$header['photo_credit'];
			}
			$content .= '</p>';
		}

		if(isset($panel['intro'])){
			$content .= '<div class="intro">'.$panel['intro'].'</div>';
		}

		if(isset($panel['content'])){
			$content .= $panel['content'];
		}

		if(isset($panel['quote'])){
			$content .= (isset($panel['opposite'])?$panel['opposite']:'');
			$content .= '<blockquote class='.strtolower($panel['position']).'>'.$panel['quote'].'</blockquote>';
		}

		if(isset($panel['image'])){
			$content .= '<p><img src="'.$panel['image']['url'].'" alt="'.$panel['caption'].'" />';

			$content .= '<span class="caption">';
			if($panel['caption'] != ""){
				$content .= $panel['caption'];
			}
			if($panel['photo_credit'] != ""){
				$content .= ($panel['caption'] != ""?", ":"").$panel['photo_credit'];
			}
			$content .= '</span></p>';

		}

		if(isset($panel['video'])){
			$content .= '<p class="video">'.$panel['video'].'</p>';
		}

		if(isset($panel['stats_image'])){
			$content .= '<div class="image_and_stats '.strtolower($panel['image_on_which_side']).'"><div><img src="'.$panel['stats_image']['url'].'" alt="'.$panel['stats_caption'].'" />';

			$content .= '<span class="caption">';
			if($panel['stats_caption'] != ""){
				$content .= $panel['stats_caption'];
			}
			if($panel['stats_photo_credit'] != ""){
				$content .= ($panel['stats_caption'] != ""?", ":"").$panel['stats_photo_credit'];
			}
			$content .= '</span></div>';

		}
		$cnt++;
	}

?>
<main class="single-editorial" role="main" aria-label="Content">
	<section>
		<article id="post-<?=the_ID()?>" <?=post_class()?>>
				<div class="title">
					<?=$postHeader?>
				</div>
				<div id="contentarea">
					<div class="panel">
						<div class="overlap"></div>
						<div class="contentarea">
							<div id="sharepanel">
								<a href="http://www.facebook.com/share.php?u=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>" title="Share this on Facebook" target="_blank">&#xf09a;</a>
								<a href="http://twitter.com/intent/tweet?original_referer=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>&amp;text=Northeastern University Magazine - <?=trim(get_field('title_panel')[0]['primary_title'])?>&amp;url=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>" title="Share this on Twitter" target="_blank">&#xf099;</a>
								<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])?>&amp;title=<?=trim(get_field('title_panel')[0]['primary_title'])?>&amp;summary=Northeastern University Magazine - <?=(get_field('title_panel')[0]['primary_title'])?>&amp;source=Northeastern University Magazine" title="Share this on Linkedin" target="_blank">&#xf0e1;</a>
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
					<?php get_footer('article'); ?>
				</div>
		</article>
	</section>
</main>
</div>
