<?

switch($folder){
	case"moon":
		$print_depth1_displays[0] = 'style="display:block;"';
	break;

	case"atopy":
		$print_depth1_displays[1] = 'style="display:block;"';
	break;

	case"decode":
		$print_depth1_displays[2] = 'style="display:block;"';
	break;

	case"cancer":
		$print_depth1_displays[3] = 'style="display:block;"';
	break;

	case"headache":
		$print_depth1_displays[4] = 'style="display:block;"';
	break;

	case"etc":
		$print_depth1_displays[5] = 'style="display:block;"';
	break;

	case"medicine":
		$print_depth1_displays[6] = 'style="display:block;"';
	break;

	case"bbs":
		$print_depth1_displays[7] = 'style="display:block;"';
	break;

	case"community":
		$print_depth1_displays[7] = 'style="display:block;"';
	break;


}
?>
<div id="wrap">
    <header>
        <div class="header-top">
            <div class="header-wrap">
                <div class="header-util">
                    <a href="./">HOME</a>                    
                    <!-- 로그인 로그아웃 문구 변경 해주세요. -->
                    <? if(isLogin() !== true){ ?>
					<a href="/?folder=member&page=join">회원가입</a>
					<a href="/?folder=member&page=login">로그인</a>
					<?} else {?>
					<a href="/?folder=member&page=proc&mode=logout">로그아웃</a>
					<?}?>
                </div>
                <a href="./" class="header-logo"><img src="/_public/images/common/logo.png" alt=""></a>
                <a href="#" class="nav-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="gnb">
                    <ul>
                        <li>
                          <a href="/?folder=moon&page=moon01">달맞이 한의원</a>
                          <div class="sub-menu" <?=$print_depth1_displays[0]?>>
                            <a href="/?folder=moon&page=moon01">달맞이한의원 소개</a>
                            <a href="/?folder=moon&page=moon02">원장 소개</a>
                            <a href="/?folder=moon&page=moon03">약재 관리</a>
                            <a href="/?folder=moon&page=moon04">진료 안내</a>
                            <a href="/?folder=moon&page=moon05">시설 둘러보기</a>
                            <a href="/?folder=moon&page=moon06">오시는 길</a>
                          </div>
                        </li>
                        <li>
                            <a href="/?folder=atopy&page=atopy01">아토피&middot;건선 치료</a>
                            <div class="sub-menu" <?=$print_depth1_displays[1]?>>
                                <a href="/?folder=atopy&page=atopy01">아토피&middot;건선 치료</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=decode&page=decode01">해독클리닉</a>
                            <div class="sub-menu" <?=$print_depth1_displays[2]?>>
                                <a href="/?folder=decode&page=decode01">해독의 이해</a>
                                <a href="/?folder=decode&page=decode02">금진옥액</a>
                                <a href="/?folder=decode&page=decode03">간해독</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=cancer&page=cancer01">암치료</a>
                            <div class="sub-menu" <?=$print_depth1_displays[3]?>>
                                <a href="/?folder=cancer&page=cancer01">암의 이해</a>
                                <a href="/?folder=cancer&page=cancer02">달맞이 암특화 치료</a>
                                <a href="/?folder=cancer&page=cancer03">달맞이 항암설계 치료</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=headache&page=headache01">두통&middot;편두통</a>
                            <div class="sub-menu" <?=$print_depth1_displays[4]?>>
                                <a href="/?folder=headache&page=headache01">두통&middot;편두통 치료</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=etc&page=etc01">기타치료</a>
                            <div class="sub-menu" <?=$print_depth1_displays[5]?>>
                                <a href="/?folder=etc&page=etc01">치매&middot;건망증</a>
                                <a href="/?folder=etc&page=etc04">수족냉증</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=medicine&page=medicine01">달맞이환약</a>
                            <div class="sub-menu" <?=$print_depth1_displays[6]?>>
                                <a href="/?folder=medicine&page=medicine01">공진단</a>
                                <a href="/?folder=medicine&page=medicine02">생정대력환</a>
                                <a href="/?folder=medicine&page=medicine03">윤부환</a>
                                <a href="/?folder=medicine&page=medicine04">온백원</a>
                                <a href="/?folder=medicine&page=medicine05">자궁단</a>
                                <a href="/?folder=medicine&page=medicine06">복명환</a>
                                <a href="/?folder=medicine&page=medicine07">대풍자환</a>
                            </div>
                        </li>
                        <li>
                            <a href="/?folder=bbs&page=list&board_id=notice">커뮤니티</a>
                            <div class="sub-menu" <?=$print_depth1_displays[7]?>>
                                <a href="/?folder=bbs&page=list&board_id=notice">공지사항</a>
                                <a href="/?folder=bbs&page=list&board_id=news">언론보도</a>
                                <a href="/?folder=bbs&page=list&board_id=counsel">온라인 상담</a>
                                <a href="/?folder=community&page=community04">진료예약</a>
                                <a href="/?folder=bbs&page=list&board_id=reward">치료사례</a>
                                <a href="/?folder=bbs&page=list&board_id=after">치료후기</a>
                                <a href="/?folder=community&page=community07">책자신청</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-bottom"></div>
    </header>

