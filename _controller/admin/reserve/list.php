<?php
	require CFG_MODEL_PATH_ABS."/class.reservation.php";
	$cls_reservation = new reservation();

	require CFG_MODEL_PATH_ABS."/class.paging.php";
	$cls_paging = new paging();
	
	$s_data["s_medical_sel"] = empty($_REQUEST["s_medical_sel"])?"":$_REQUEST["s_medical_sel"];	
	$s_data["s_r_time"] = empty($_REQUEST["s_r_time"])?"":$_REQUEST["s_r_time"];	
	$s_data["s_username"] = empty($_REQUEST["s_username"])?"":$_REQUEST["s_username"];	
	$s_data["s_email"] = empty($_REQUEST["s_email"])?"":$_REQUEST["s_email"];
	$s_data["s_hp"] = empty($_REQUEST["s_hp"])?"":$_REQUEST["s_hp"];
	$order_by_key = empty($_REQUEST["order_by_key"])?"add_date":$_REQUEST["order_by_key"];
	$desc_key = empty($_REQUEST["desc_key"])?"desc":$_REQUEST["desc_key"];
	$s_date = empty($_REQUEST["s_date"])?"":$_REQUEST["s_date"];
	$e_date = empty($_REQUEST["e_date"])?"":$_REQUEST["e_date"];

	$row = $cls_reservation->get_list($paging, $list_max, array(
		"s_medical_sel"=>$s_medical_sel,
		"s_r_time"=>$s_r_time,
		"s_username"=>$s_username,
		"s_email"=>$s_email,
		"s_hp"=>$s_hp,
		"s_key"=>$s_key,
		"s_value"=>$s_value,
		"s_date"=>$s_date,
		"e_date"=>$e_date,
		"order_by_key"=>$order_by_key,
		"desc_key"=>$desc_key
	));
	$cnt = $cls_reservation->getTotalCount();
	$rownum = $cls_reservation->getRowNum();


// 페이징
	$url_option = "&folder=".$folder."&page=".$page;
	$search_option = "&s_medical_sel=".$s_medical_sel."&s_username=".$s_username."&s_email=".$s_email."&s_date=".$s_date."&e_date=".$e_date."&s_r_time=".$s_r_time."&s_hp=".$s_hp."&desc_key=".$desc_key."&order_by_key=".$order_by_key;
	$cls_paging->init($cnt, $paging, $list_max, $paging_max, $_SERVER["PHP_SELF"], $url_option.$search_option, "default");


?>
<link rel="stylesheet" href="<?php echo CFG_PUBLIC_PATH?>/kr/jQuery/datepicker/jquery-ui-1.9.2.custom.css">
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year { width: 73px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script language="JavaScript" src="<?php echo CFG_PUBLIC_PATH?>/kr/jQuery/datepicker/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript">
	$(function() {
		$("#s_date").datepicker({
			dateFormat : 'yy-mm-dd',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)', '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월', '7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			firstDay: 0,
			isRTL: false,
			changeMonth : true,
			changeYear : true,
			showMonthAfterYear : true,
			autoSize : false
		});

		$("#e_date").datepicker({
			dateFormat : 'yy-mm-dd',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)', '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월', '7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			firstDay: 0,
			isRTL: false,
			changeMonth : true,
			changeYear : true,
			showMonthAfterYear : true,
			autoSize : false
		});

		// 모두선택
		$("#all_check").click(function() {
			if($(this).is(":checked")) {
				$("input:checkbox[name='idx[]']").prop("checked", true);
			} else {
				$("input:checkbox[name='idx[]']").prop("checked", false);
			}
		});
	});

	var frm = document.action_form;

	function check_form(frm, action_mode)
	{
		var frm = eval(frm);

		frm.action_mode.value = action_mode;
		var ele_num = 0;
		for (var i=0; i<frm.elements.length; i++)
		{
			var ele = frm.elements[i];
			if (ele.name == 'idx[]')
			{
				if (ele.checked == true)
					ele_num++;
			}
		}

		switch (action_mode)
		{
			case "edit" : var action_mode_name = "수정"; break;
			case "del" : var action_mode_name = "삭제"; break;
		}

		if (ele_num < 1)
		{
			alert(action_mode_name +"할 책 신청 을 체크해주세요.");
			return false;
		}

		if (confirm("선택된 내용에 대해서 "+ action_mode_name +" 합니다.\n\n "+ action_mode_name +" 하시겠습니까?"))
			frm.submit();
	}

	function check_search_form()
	{
		document.search_form.submit();
	}
</script>



<!-- 본문내용 시작 -->
<div id="admin_body" style="width:1200px;">
	<!-- 네비 시작 -->
	<div class="navigation">
		<ul><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/ar_box01.gif" align="absmiddle"/> <span>관리자메인 &gt; 책 신청 관리</span></ul>
	</div>
	<!-- 네비 끝 -->

	<!-- 페이지타이틀 시작 -->
	<div class="pagename">
		<ul>
			<table border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:500px;"/>
					<col/>
				</colgroup>
				<tbody>
				<tr>
					<td><img src="<?php echo CFG_PUBLIC_PATH; ?>/admin/image/ar_box01.gif"> <span>책 신청 정보 검색/수정</span></td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</ul>
	</div>
	<!-- 페이지타이틀 끝 -->

	<!-- 검색폼 -->
	<form name="search_form" action="/admin.php" method="GET" onSubmit="return false;">
	<input type="hidden" name="folder" value="<?php echo $folder?>">
	<input type="hidden" name="page" value="<?php echo $page?>">
	<div class="edit_frame">
		<ul>
			<li>
				<table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;">
					<colgroup>
						<col style="width:120px;"/>
						<col/>
						<col style="width:120px;"/>
						<col/>
					</colgroup>
					<thead>
						<tr>
							<th>진료 과목</th>
							<td style="padding:5px 10px;"><?php echo make_select_form("s_medical_sel", array(""=>"전체", "a"=>"불면증", "b"=>"피부질환(아토피)", "c"=>"암치료", "d"=>"두통", "e"=>"수족냉증", "f"=>"해독", "g"=>"기타"), "", $s_medical_sel)?></td>
							<th>이름</th>
							<td><span><input type="text" name="s_username" value="<?php echo $s_data["s_username"]; ?>" size="20" onKeyUp="onkeyUpChk('check_search_form');"></span></td>
						</tr>
					</thead>
					<tbody>
						<tr>						
							<th>이메일</th>
							<td><span><input type="text" name="s_email" value="<?php echo $s_data["s_email"]; ?>" size="20" onKeyUp="onkeyUpChk('check_search_form');"></span></td>
							<th>연락처</th>
							<td><span><input type="text" name="s_hp" value="<?php echo $s_data["s_hp"]; ?>" size="20" onKeyUp="onkeyUpChk('check_search_form');"></span></td>			
						</tr>
						<tr>
							<th>예약일</th>
							<td style="padding:5px 10px;">
								<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" size="10" readOnly>
								&nbsp;~&nbsp;
								<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" size="10" readOnly>
							</td>
							<th>예약 시간</th>
							<td style="padding:5px 10px;">
								<select name="s_r_time" id="s_r_time" value="<?=$s_r_time?>">
									<option value="">선택하세요</option>
									<option value="9">오전 09:00</option>
									<option value="10">오전 10:00</option>
									<option value="11">오전 11:00</option>
									<option value="12">오후 12:00</option>
									<option value="13">오후 01:00</option>
									<option value="14">오후 02:00</option>
									<option value="15">오후 03:00</option>
									<option value="16">오후 04:00</option>
									<option value="17">오후 05:00</option>
									<option value="18">오후 06:00</option>
									<option value="19">오후 07:00</option>
									<option value="20">오후 08:00</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>정렬방식</th>
							<td style="padding:5px 10px;" colspan="3">
								<?php echo make_select_form("order_by_key", array("add_date"=>"등록일자"), "", $order_by_key)?>&nbsp;
								<?php echo make_select_form("desc_key", array("asc"=>"내림차순", "desc"=>"오름차순"), "", $desc_key)?>
							</td>
						</tr>
					</tbody>
				</table>
			</li>
		</ul>
		<ul style="padding:0 0; text-align:center;">
			<li>
				<input type="button" value="검색" class="button_h" onClick="check_search_form();"/>
				<input type="button" value="검색 초기화" class="button_h" onClick="Go('/admin.php?folder=reserve&page=list')"/>
			</li>
		</ul>
	</div>
	</form>
	<!-- //검색폼 -->

	<div class="pagename">
		<ul>
			<table border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:500px;"/>
					<col/>
				</colgroup>
				<tbody>
				<tr>
					<td>검색된 책 신청 목록 총 <font color=green><?=$cnt?></font> 개</td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</ul>
	</div>

	<form name="action_form" action="/admin.php" method="post" onSubmit="return false;">
	<input type="hidden" name="folder" value="<?php echo $folder?>">
	<input type="hidden" name="page" value="meet_proc">
	<input type="hidden" name="mode" value="edit_from_list">
	<input type="hidden" name="action_mode" value="">
	<input type="hidden" name="s_date" value="<?php echo $s_date;?>">
	<input type="hidden" name="e_date" value="<?php echo $e_date;?>">
	<input type="hidden" name="s_pd_name" value="<?php echo $s_pd_name;?>">
	<input type="hidden" name="s_flag_sale" value="<?php echo $s_flag_sale;?>">
	<input type="hidden" name="order_by_key" value="<?php echo $order_by_key?>">
	<div class="list_frame">
		<ul>
			<li>
				<table border="0" cellspacing="0" cellpadding="0">
				<colgroup>
					<col style="width:70px;"/>
					<col style="width:150px;"/>
					<col style="width:100px;"/>
					<col style="width:120px;"/>
					<col style="width:70px;"/>
					<col style="width:120px;"/>
					<col style="width:120px;"/>
					<col style="width:150px;"/>
					<col style="width:50px;"/>
				</colgroup>
				<thead>
					<tr>
						<th>번호</th>
						<th>이름</th>
						<th>진료 과목</th>
						<th>예약일</th>
						<th>예약 시간</th>
						<th>연락처</th>
						<th>이메일</th>
						<th>등록일</th>
						<th>관리</th>
					</tr>
				</thead>
				<tbody>
<?php
	if (count($row["idx"]) > 0)
	{
		for ($i=0; $i<count($row["idx"]); $i++)
		{
			switch($row['medical_sel'][$i]) {
			case a:
				$medical_sel = "감기";
				break;
			case b:
				$medical_sel = "몸살";
				break;
			case c:
				$medical_sel = "두통";
				break;
			}
			if($row["r_time"][$i] > 12) 
			{
				$r_time = $row["r_time"][$i]-12;
				$r_time = "오후 ".$r_time."시";
			}
			if($row["r_time"][$i] < 12) 
			{
				$r_time = "오전 ".$row["r_time"][$i]."시";
			}
			if($row["r_time"][$i] == 12) 
			{
				$r_time = "오후 ".$row["r_time"][$i]."시";
			}
?>
					<tr>
						<td><?php echo $rownum?></td>
						<td style="text-align:center; line-height:15px;">
							<a href="/admin.php?folder=<?php echo $folder?>&page=edit&idx=<?php echo $row["idx"][$i];?><?php echo $search_option;?>">
								<?php echo $row["r_name"][$i];?>
							</a>
						</td>
						<td style="text-align:center; padding-left:10px;">
								<?php echo $medical_sel; ?>
						</td>
						<td style="text-align:center; line-height:15px;">
							<?php echo $row["r_day"][$i];?>
						</td>
						<td style="text-align:center; line-height:15px;">
							<?php echo $r_time;?>
						</td>
						<td style="text-align:center; line-height:15px;">
							<?php echo $row["r_tel"][$i];?>
						</td>
						<td style="text-align:center; line-height:15px;">
							<?php echo $row["r_email"][$i];?>
						</td>
						<td style="text-align:center; line-height:15px;">
							<?php echo ($row["add_date"][$i]);?>
						</td>
						<td>
							<input type="button" value="수정" class="button_m" onclick="Go('/admin.php?folder=<?php echo $folder?>&page=edit&idx=<?php echo $row["idx"][$i];?><?php echo $search_option;?>');" style="cursor:pointer;">
						</td>
					</tr>
	<?php
				$rownum--;
			}
		}
		else
		{
	?>
					<tr style="height:100px;">
						<td colspan="8" style="text-align:center; background-color:#FFFFFF;">등록된 책 신청이 없습니다.</td>
					</tr>
	<?php
		}
	?>
				</tbody>
				</table>
			</li>
		</ul>
	</div>
	</form>

	<table border="0" cellspacing="1" cellpadding="3" style="width:100%; margin:0px auto;">
		<tr style="height:40px;">
			<td style="text-align:center;"><?php echo ($cnt>0?$cls_paging->paging():"")?></td>
		</tr>
	</table>
</div>
<!-- 본문내용끝 -->