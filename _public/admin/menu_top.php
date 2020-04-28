<?php
	require CFG_MODEL_PATH_ABS."/class.board_info.php";
	$cls_board_info = new board_info();

	$top_menu_bbs_list = $cls_board_info->get_list_no_paging(array(), "idx, board_id, board_name");

	switch ($folder)
	{
		//case "reserve" : $this_menu_num = 2; break;
		//case "shop" : $this_menu_num = 3; break;
		case "member" : $this_menu_num = 2; break;
		case "reserve" : $this_menu_num = 3; break;
		case "book" : $this_menu_num = 4; break;
		case "statistics" : $this_menu_num = 5; break;
		case "bbs" : $this_menu_num = 6; break;
		default : $this_menu_num = 1; break;
	}

// 게시글 관리 클릭 시 이동 할 페이지
	if ($_SESSION["ss_admin_id"] == "pointweb")
		$this_bbs_page = "cfg_list";
	else
		$this_bbs_page = "list&board_id=tech";

	$copyright_info = $cls_admin->get_view_config();
?>
<script type="text/javascript">
function top_menu_change(num)
{
	$(".admin_top_menu_sub_category ul li").hide();
	$("#admin_menu_sub_"+ num).show();
}

$(document).ready(function() {
	top_menu_change(<?php echo $this_menu_num?>);

	$(".admin_top_menu_main_category .admin_menu_link").bind("mouseenter", function() {
		var this_menu_num = this.id.replace(/admin_menu_/g, "");
		top_menu_change(this_menu_num);
	});

	$(".admin_category").bind("mouseleave", function() {
		top_menu_change(<?php echo $this_menu_num?>);
	});
});
</script>
<div id="admin_top_menu">
	<div class="admin_top_menu_peak">
		<table border="0" cellspacing="0" cellpadding="0">
			<colgroup>
				<col style="width:600px;"/>
				<col/>
				<col style="width:60px;"/>
			</colgroup>
			<thead>
				<tr>
					<td><a href="<?php echo CFG_ADMIN_BASE_PATH;?>" style="float:left; display:inline;"><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_logo.gif"/></a></td>
					<td style="text-align:right;">
						<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/icon_s_lock02.gif" align="absmiddle">
						<span style="font-weight:bold;"><?php echo $_SESSION["ss_admin_name"]; ?></span><span>님 로그인중</span>
					</td>
					<td style="text-align:right;"><input type="button" value="로그아웃" class="button_s" onClick="Go('<?php echo CFG_ADMIN_BASE_PATH;?>?folder=login&page=proc&mode=logout');"/></td>
				</tr>
			</thead>
		</table>
	</div>

	<div class="admin_category">
		<div class="admin_top_menu_main_category">
			<table border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:70px;"/>
					<col style="width:4px;"/>
					<col style="width:70px;"/>
					<col style="width:4px;"/>
					<col style="width:70px;"/>
					<col style="width:4px;"/>
					<col style="width:100px;"/>
					<col style="width:4px;"/>
					<col style="width:85px;"/>
					<col style="width:4px;"/>
					<col style="width:85px;"/>
					<col/>
				</colgroup>
				<thead>
					<tr>
						<td id="admin_menu_1" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH;?>"<?php echo $this_menu_num==1?" class=\"on\"":""; ?>>운영 관리</a></td>
						<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_menu_gap.gif"></td>
						
						<td id="admin_menu_2" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=member&page=list"<?php echo $this_menu_num==2?" class=\"on\"":""; ?>>회원 관리</a></td>
						<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_menu_gap.gif"></td>
						<td id="admin_menu_3" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=reserve&page=list"<?php echo $this_menu_num==3?" class=\"on\"":""; ?>>예약 관리</a></td>
						<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_menu_gap.gif"></td>
						<td id="admin_menu_4" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH; ?>?folder=book&page=list"<?php echo $this_menu_num==4?" class=\"on\"":""?>>책자신청 관리</a></td>
						<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_menu_gap.gif"></td>
						<td id="admin_menu_5" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=statistics&page=connect"<?php echo $this_menu_num==5?" class=\"on\"":""; ?>>통계 관리</a></td>
						<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_menu_gap.gif"></td>
						<td id="admin_menu_6" class="admin_menu_link"><a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=bbs&page=<?php echo $this_bbs_page; ?>"<?php echo $this_menu_num==6?" class=\"on\"":""; ?>>게시글 관리</a></td>
						<td>&nbsp;</td>
					</tr>
				</thead>
			</table>
		</div>

		<div class="admin_top_menu_sub_category">
			<ul>
				<li id="admin_menu_sub_1" alt="운영 관리">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>"<?php echo in_array($page, array("", "index"))?" class=\"on\"":""; ?>>기본 운영정보</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=popup_list"<?php echo strncmp($page, "popup_", 6)==0?" class=\"on\"":""; ?>>팝업창 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=member_list"<?php echo strncmp($page, "member_", 7)==0?" class=\"on\"":""; ?>>운영진 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<!-- <a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=banner_list"<?php echo strncmp($page, "banner_", 7)==0?" class=\"on\"":""; ?>>배너 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif"> -->
					<!--a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=sms_index"<?php echo $page=="sms_index"?" class=\"on\"":""; ?>>SMS 설정</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=sms_log"<?php echo $page=="sms_log"?" class=\"on\"":""; ?>>SMS 발송내역</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif"-->
<?php
	if ($_SESSION["ss_admin_id"] == "pointweb")
	{
?>
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=manage&page=config.array_list"<?php echo $page=="config.array_list"?" class=\"on\"":""; ?>>설정배열 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
<?php
	}
?>
				</li>
				<li id="admin_menu_sub_2" alt="회원 관리">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=member&page=list"<?php echo $folder=="member"?" class=\"on\"":""; ?>>회원 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<!--<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=shop&page=product_list"<?php echo $page=="product_list"?" class=\"on\"":""; ?>>제품 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=shop&page=category_list"<?php echo $folder.$page=="shopcategory_list"?" class=\"on\"":""; ?>>제품 카테고리 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">-->
				</li>				
				<li id="admin_menu_sub_3" alt="예약 관리">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=reserve&page=list"<?php echo $page=="list"?" class=\"on\"":""; ?>>예약 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
				</li>				

				<li id="admin_menu_sub_4" alt="책자신청 관리">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=book&page=list"<?php echo $folder=="book"?" class=\"on\"":""; ?>>책자신청 관리</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">					
				</li>	

				<li id="admin_menu_sub_5" alt="통계 관리">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=statistics&page=connect"<?php echo $page=="connect"?" class=\"on\"":""; ?>>접속통계1</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=statistics&page=referrer"<?php echo $page=="referrer"?" class=\"on\"":""; ?>>접속통계2</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
				</li>
				<li id="admin_menu_sub_6" alt="게시판 관리">
<?php
	if ($_SESSION["ss_admin_id"] == "pointweb")
	{
?>
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=bbs&page=cfg_list"<?php echo strncmp($page, "cfg_", 4)==0?" class=\"on\"":""; ?>>게시판 설정</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
<?php
	}

	if (count($top_menu_bbs_list["idx"]) > 0)
	{
		for ($i=0; $i<count($top_menu_bbs_list["idx"]); $i++)
		{
?>
					<a href="<?php echo CFG_ADMIN_BASE_PATH;?>?folder=bbs&page=list&board_id=<?php echo $top_menu_bbs_list["board_id"][$i]; ?>"<?php echo $board_id==$top_menu_bbs_list["board_id"][$i]?" class=\"on\"":""; ?>>
						<?php echo $top_menu_bbs_list["board_name"][$i]; ?>
<?php
			if (strpos($top_menu_bbs_list["board_id"][$i], "_eng") !== false) echo "(영문)";
?>
					</a>
					<img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/main_sub_gap.gif">
<?php
		}
	}
?>
				</li>
			</ul>
		</div>
	</div>
</div>
