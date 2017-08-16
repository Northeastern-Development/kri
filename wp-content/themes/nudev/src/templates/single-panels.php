<?php
	/*

	Template Name: Multi-panel
	Template Post Type: post

	*/

	// grab the header
	get_header();

	// grab the post details
	the_post();

	// get the author information
	$obj = get_field('select_author');
	$post = $obj;
	setup_postdata($post);
	$author['name'] = get_field('author_name');
	$author['sbio'] = get_field('short_bio');
	wp_reset_postdata();

	// get the rubrick
	$rubrick = get_field('rubrick');

// get the header area content
	$guide = '<div id="title" class="%s"><span class="rubrick" style="color:'.get_field('title_panel')[0]['color'].'; border: solid '.get_field('title_panel')[0]['color'].' 1px;">%s</span>%s%s%s<br /></div><img src="%s" alt="%s" />';

	$postHeader = sprintf(
		 $guide
		,strtolower(get_field('title_panel')[0]['title_position'])
		,ucwords($rubrick->name)
		,'<h1 style="color:'.get_field('title_panel')[0]['color'].';">'.trim(get_field('title_panel')[0]['primary_title']).'</h1>'
		,(get_field('title_panel')[0]['secondary_title']?'<h2 style="color:'.get_field('title_panel')[0]['color'].';">'.trim(get_field('title_panel')[0]['secondary_title']).'</h2>':'')
		,(isset($author['name'])?'<div class="tick" style="color: '.get_field('title_panel')[0]['color'].'; background: '.get_field('title_panel')[0]['color'].';"></div><span class="authorname" style="color: '.get_field('title_panel')[0]['color'].';">By '.ucwords(trim($author['name'])).'<span>':'')
		,get_field('title_panel')[0]['image']['url']
		,get_field('title_panel')[0]['caption']
	);


	$cnt = 0;
	$max = count(get_field('panels'));

	$content = '<div id="contentarea">';
	foreach(get_field('panels') as $panel){

		$content .= '<div id="panel_'.$cnt.'" class="panel" style="'.($panel['panel_background_color']?' background: '.$panel['panel_background_color'].';':'').'">';

		// figure out any side notes that have been added to a panel
		if($panel['show_side_note'] && $panel['type_of_side_note'] != "---"){
			$content .= '<div class="sidenote'.(strtolower($panel['type_of_side_note']) == "copy" && strtolower($panel['side_note_shape']) == "circle"?' circle':'').' '.str_replace(" ","",strtolower($panel['side_note_position'])).'" style="background:'.$panel['side_note_background_color'].';'.($panel['side_note_border_color']?' border: solid '.$panel['side_note_border_color'].' '.$panel['side_note_border_weight'].'px;':'').''.(strtolower($panel['side_note_shape']) == "circle"?' height:'.$panel['side_note_width'].($panel['side_note_width'] != "auto"?'vw':'').'; width:'.$panel['side_note_width'].($panel['side_note_width'] != "auto"?'vw':'').';':'').(strtolower($panel['panel_type']) == "image"?' width:'.$panel['side_note_width'].($panel['side_note_width'] != "auto"?'vw':'').';':'').(strtolower($panel['type_of_side_note']) == "copy"?' padding: 10px;':'').'">';

			// what type of side note content are we going to be showing???
			switch (strtolower($panel['type_of_side_note'])){
				case "copy":
					$content .= $panel['side_note_copy'];
					break;
				case "image":
					$content .= '<img src="'.$panel['side_note_image']['url'].'" alt="side note image">';
					break;
				case "video":
					$content .= $panel['side_note_video'];
					break;
				default:
					$content .= 'Unable to load content';
					break;
			}

			$content .= '</div>';
		}

		// need to determine if we are looking at the first panel, as this will ALWAYS overlap and contain the header photo caption and credit

		if($cnt == 0){
			$content .= '<div class="overlap" style="background:'.$panel['copy_background_color'].';"></div>';
		}else{
			if($panel['copy_background_color'] && $panel['overlap_previous_panel']){
				$content .= '<div class="overlap" style="background:'.$panel['copy_background_color'].';"></div>';
			}
		}

		if($panel['panel_background_image']){
			$pos = "left";
			if($panel['show_side_note'] && $panel['type_of_side_note'] != "---"){
				if(str_replace(" ","",strtolower($panel['side_note_position'])) === "lower-left"){
					$pos = "right";
				}
			}

			$content .= '<img src="'.$panel['panel_background_image']['url'].'" alt="'.$panel['background_image_caption'].'" />';
			if($panel['background_image_caption'] != ""){
				$content .= '<div class="contentarea" style="background:'.$panel['copy_background_color'].'; color:'.$panel['copy_color'].';">';

				$content .= '<p class="caption">';
				if($panel['background_image_caption'] != ""){
					$content .= $panel['background_image_caption'];
				}
				if($panel['background_image_photo_credit'] != ""){
					$content .= ($panel['background_image_caption'] != ""?", ":"").$panel['background_image_photo_credit'];
				}
				$content .= '</p></div>';

			}
		}

		if($panel['copy']){
			$content .= '<div class="contentarea" style="background:'.$panel['copy_background_color'].'; color:'.$panel['copy_color'].';">';
			if($cnt == 0){
				$content .= '<p class="caption">'.(get_field('title_panel')[0]['caption'] != ""?get_field('title_panel')[0]['caption'].(get_field('title_panel')[0]['photo_credit'] != ""?", ".get_field('title_panel')[0]['photo_credit']:""):"").'</p>';
			}
			// $content .= ($cnt == 0? file_get_contents(locate_template("includes/sharepanel.php")) :'');
			// $content .= ($cnt == 0? get_template_part(locate_template("includes/sharepanel.php")) :'');
			if($cnt == 0){
				$content .= '<div id="sharepanel"><a href="http://www.facebook.com/share.php?u='.urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]).'" title="Share this on Facebook" target="_blank">&#xf09a;</a><a href="http://twitter.com/intent/tweet?original_referer='.urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]).'&amp;text=Northeastern University Magazine -'.trim(get_field('title_panel')[0]['primary_title']).'&amp;url='.urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]).'" title="Share this on Twitter" target="_blank">&#xf099;</a><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]).'&amp;title=Northeastern University Magazine -'.trim(get_field('title_panel')[0]['primary_title']).'&amp;summary=Northeastern University Magazine -'.trim(get_field('title_panel')[0]['secondary_title']).'&amp;source=Northeastern University Magazine" title="Share this on Linkedin" target="_blank">&#xf0e1;</a><a href="mailto:person@email.com?subject=Northeastern University Magazine - '.trim(get_field('title_panel')[0]['primary_title']).'&body=I thought that you might find this article interesting: '.urlencode("http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]).'" title="Share this via email" >&#xf064;</a></div>';
			}

			if(!$panel['overlap_previous_panel']){
				$content .= '<p>&nbsp;</p>';
			}
			$content .= str_replace('<blockquote','<blockquote class="'.strtolower($panel['pullquote_position']).'"',$panel['copy']);
			$content .= '</div>';
		}
		$content .= '</div>';
		$cnt++;
	}
	$content .= '<div class="panel author" style="background: #ffffff;"><div class="contentarea" style="background: #ffffff;">';
	$content .= '<div id="authorbio">'.trim($author['sbio']).'</div>';
?>

<main class="single-panels" role="main" aria-label="Content">
	<section>
		<article id="post-<?=the_ID()?>" <?=post_class()?>>
			<div class="panel title">
				<?=$postHeader?>
			</div>
			<?=$content?>
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

			</div></div>
			<?php get_footer('article'); ?>
			</div>
		</article>
	</section>
</main>
