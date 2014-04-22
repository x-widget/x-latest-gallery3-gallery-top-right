<?
	widget_css();
	
$_bo_table = $widget_config['forum1'];
$_no_of_posts = $widget_config['default_no_of_posts'];
if ( empty($_bo_table) ) $_bo_table = $widget_config['default_forum_id'];

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>

<div class='latest-top-right'>
	
	<?
	if ( $list ) {
		$_wr_id = $list[0]['wr_id'];
		$imgsrc = x::post_thumbnail($_bo_table, $_wr_id, 307, 233);
		$img = $imgsrc['src'];
		if ( empty($img) ) {
			$_wr_content = db::result("SELECT wr_content FROM $g5[write_prefix]$_bo_table WHERE wr_id='$_wr_id'");
			$image_from_tag = g::thumbnail_from_image_tag( $_wr_content, $_bo_table, 307, 233 );
			if ( empty($image_from_tag) ) $image_from_tag = g::thumbnail_from_image_tag( "<img src='".x::url()."widget/$widget_config[name]/img/no_image.png'/>", $_bo_table, 538, 213 );
			$img = $image_from_tag;
		}
	}
	else $img = x::url()."widget/$widget_config[name]/img/no_image.png";
	?>
	
	<div class='top-right'>
			<? if ( $list ) {
					$url = $list[0]['url'];
					$subject = cut_str($list[0]['wr_subject'],10);
					$content = cut_str($list[0]['wr_content'], 20);
			}
			else {
				$url = "javascript:void(0);";
				$subject = "회원님께서는 현재";
				$content = "필고 갤러리 테마 No.3를 선택 하셨습니다.";
			}
			?>
			
		<img src="<?=$img?>"/>
		<div class='top-right-container'>
			<div class='top-right-subject'><a href="<?=$url?>" ><?=$subject?></div>
			<div class='top-right-content'><a href="<?=$url?>" ><?=$content?></div>
		</div>	
		<a href="<?=$url?>" class='read_more'></a>
	</div>
</div>