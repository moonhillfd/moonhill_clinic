<?php
	$idx = empty($_GET["idx"])?alertnBack("잘못된 경로!!!"):$_GET["idx"];

	require CFG_MODEL_PATH_ABS."/class.reservation.php";
	$cls_reservation = new reservation();

	$s_use_flag = empty($_REQUEST["s_use_flag"])?"":$_REQUEST["s_use_flag"];
	$s_subject = empty($_REQUEST["s_subject"])?"":$_REQUEST["s_subject"];
	$s_place = empty($_REQUEST["s_place"])?"":$_REQUEST["s_place"];
	$order_by_key = empty($_REQUEST["order_by_key"])?"add_date":$_REQUEST["order_by_key"];
	$desc_key = empty($_REQUEST["desc_key"])?"desc":$_REQUEST["desc_key"];
	$s_date = empty($_REQUEST["s_date"])?"":$_REQUEST["s_date"];
	$e_date = empty($_REQUEST["e_date"])?"":$_REQUEST["e_date"];

	$row = $cls_reservation->get_admin_view($idx);

?>
<link rel="StyleSheet" href="<?php echo CFG_PUBLIC_PATH; ?>/kr/jQuery/ui/jquery-ui.min.css" type="text/css">

<script type="text/javascript" src="<?php echo CFG_PUBLIC_PATH; ?>/kr/jQuery/ui/jquery-ui.min.js"></script>

<style type="text/css">
	.ui-datepicker { font:12px dotum; }
	.ui-datepicker select.ui-datepicker-month,
	.ui-datepicker select.ui-datepicker-year { width: 73px;}
	.ui-datepicker-trigger { margin:0 0 -5px 2px; }
</style>
<script type="text/javascript">

$(document).ready(function() {
	$("#r_day").datepicker({
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
});


	function check_form()
	{
		var f = document.frm;
		var index = $("#r_time_id option").index($("#r_time_id option:selected"));

		if(isBlank(f.medical_sel.value)) {
		alert("진료과목을 입력해주세요.");
		f.medical_sel.focus();
		return;
	}


	else if(isBlank(f.r_day.value)) {
		alert("예약일을 입력해주세요.");
		f.r_day.focus();
		return;
	}


	else if(index == 0) {
		alert("예약시간을 선택해주세요.");
		f.r_time.focus();
		return;
	}


	else if(isBlank(f.r_name.value)) {
		alert("이름을 입력해주세요.");
		f.r_name.focus();
		return;
	}

	else if(isBlank(f.r_tel.value)) {
		alert("연락처을 입력해주세요.");
		f.r_tel.focus();
		return;
	}

	else if(isBlank(f.r_email.value)) {
		alert("이메일을 입력해주세요.");
		f.r_email.focus();
		return;
	}

	else 
	{
		oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		f.submit();
	}
}

	
</script>
<div id="admin_body">
	<!-- 네비시작 -->
	<div class="navigation">
		<ul><img src="<?php echo CFG_PUBLIC_PATH?>/admin/image/ar_box01.gif" align="absmiddle"> <span>관리자메인 &gt; 예약 관리</span></ul>
	</div>
	<!-- //네비시작 -->
	<!-- 페이지타이틀 -->
	<div class="pagename">
		<ul><img src="<?php echo CFG_PUBLIC_PATH?>/admin/image/ar_box01.gif"> <span>예약 정보 수정</span></ul>
	</div>
	<!-- //페이지타이틀 -->

	<!-- 본문내용시작 -->
	<div class="edit_frame" style="width:1030px;">
		<ul>
			<li>
				<form name="frm" action="/admin.php" method="post" encType="multipart/form-data" onSubmit="return false;">
				<input type="hidden" name="folder" value="<?php echo $folder;?>">
				<input type="hidden" name="page" value="proc">
				<input type="hidden" name="idx" id="idx" value="<?php echo $idx;?>">
				<input type="hidden" name="mode" value="edit">

				<table border="0" cellpadding="0" cellspacing="0">
					<colgroup>
						<col width="200"/>
						<col width="350"/>
						<col width="180"/>
						<col/>
					</colgroup>
					<thead>
						<tr>
							<th>진료 과목</th>
								<td><span><?php echo make_select_form("medical_sel", array(""=>"전체", "a"=>"불면증", "b"=>"피부질환(아토피)", "c"=>"암치료", "d"=>"두통", "e"=>"수족냉증", "f"=>"해독", "g"=>"기타"), "", $row["medical_sel"])?></span>
							</td>
							<th>이름</th>
							<td ><span><input type="text" name="r_name" value="<?php echo $row["r_name"];?>"></span></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>연락처</th>
							<td ><span><input type="text" name="r_tel" value="<?php echo $row["r_tel"];?>" maxlength="14"></span></td>
							<th>이메일</th>
							<td><span><input type="text" name="r_email" value="<?php echo $row["r_email"];?>"></span></td>
						</tr>
						<tr>
							<th>예약일</th>
							<td><span><input type="text" name="r_day" id="r_day" value="<?php echo $row["r_day"];?>"></span></td>
							<th>예약시간</th>
							<td>
								<span>
									<?php echo make_select_form("r_time",$reserve_time, "", $row["r_time"])?>
								</span>
							</td>
						</tr>
						<tr>
							<th>내용</th>
							<td colspan="3">
								<div style="padding:10px;">
									<textarea name="r_content" id="content" rows="10" cols="100" style="width:100%; height:250px; display:none"><?php echo $row["r_content"]; ?></textarea>
								</div>
							</td>
						</tr>
						<tr>
							<th>등록일</th>
							<td colspan="3"><span><?php echo $row["add_date"];?></span></td>
						</tr>
						<tr>
							<th>수정일</th>
							<td colspan="3"><span><?php echo $row["edit_date"];?></span></td>
						</tr>
					</tbody>
				</table>
				</form>
			</li>
		</ul>
		<ul style="text-align:center; padding-top:10px; padding-bottom:10px;">
			<input type="button" value="리스트" class="button_l" onClick="Go('/admin.php?folder=<?php echo $folder;?>&page=list');"/>
			<input type="button" value="예약  수정" class="button_l" onClick="check_form();"/>
			<input type="button" value="예약  삭제" class="button_l" onClick="Go_del('/admin.php?folder=<?php echo $folder;?>&page=proc&mode=del&idx=<?php echo $idx;?>');"/>
			<input type="button" value="취소" class="button_l" onClick="history.back();"/>
		</ul>

	</div>
</div>

<script type="text/javascript" src="<?php echo CFG_PUBLIC_PATH; ?>/smart_editor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "content",
	sSkinURI: "<?php echo CFG_PUBLIC_PATH; ?>/smart_editor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});
</script>