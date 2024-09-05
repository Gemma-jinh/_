<?php
$arrTmpMenu = explode('/', @$this->reqData['tpf']);
$tmp        = @$arrTmpMenu[0];
$menu_main  = @$arrTmpMenu[1];
$menu_sub   = @$arrTmpMenu[2];

$arrMenu[$menu_main] = 'active ';
$arrMenuSub[$menu_main][$menu_sub] = ' class="active"';

$arrAdminMenuTmp = $this->objDBH->getRows("select code,menu,is_use from admin_menu_list order by code");  // 게시판 리스트
foreach($arrAdminMenuTmp['list'] as $key => $val) {
    $arrAdminMenu[$val['menu']] = $val['is_use'];
}
$arrBoard = $this->objDBH->getRows("select code,title,is_mass,is_order from board order by code");  // 게시판 리스트
$arrForm = $this->objDBH->getRows("select code,title from form order by code");                     // 폼 리스트
?>

<!-- sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
<!--    // 쇼핑몰
            <li class="<?=@$arrMenu['order']?>treeview">
                <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>주문 관리</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['list']) ? $arrMenuSub['list'] : ""?>><a href="?tpf=admin/order/list"><i class="fa fa-circle-o"></i> 주문 리스트</a></li>
                    <li<?=!empty($arrMenuSub['level']) ? $arrMenuSub['level'] : ""?>><a href="https://merchant.eximbay.com/backoffice/common/login.do" target="_new"><i class="fa fa-circle-o"></i> 액심베이 상점관리자</a></li>
                </ul>
            </li>
-->
<?php
if ($arrAdminMenu['menu'] == 'y') {
?>
            <li class="<?=@$arrMenu['menu']?>treeview">
                <a href="#">
                <i class="fa fa-file-text-o"></i> <span>메뉴 관리</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['menu']['list']) ? $arrMenuSub['menu']['list'] : ""?>><a href="?tpf=admin/menu/list"><i class="fa fa-circle-o"></i> 메뉴 관리</a></li>
                    <li<?=!empty($arrMenuSub['menu']['head']) ? $arrMenuSub['menu']['head'] : ""?>><a href="?tpf=admin/menu/head"><i class="fa fa-circle-o"></i> 헤더 관리</a></li>
                    <li<?=!empty($arrMenuSub['menu']['bottom']) ? $arrMenuSub['menu']['bottom'] : ""?>><a href="?tpf=admin/menu/bottom"><i class="fa fa-circle-o"></i> 하단 관리</a></li>
                    <li<?=!empty($arrMenuSub['menu']['meta']) ? $arrMenuSub['menu']['meta'] : ""?>><a href="?tpf=admin/menu/meta"><i class="fa fa-circle-o"></i> 메타 관리</a></li>
                    <li<?=!empty($arrMenuSub['menu']['sitemap']) ? $arrMenuSub['menu']['sitemap'] : ""?>><a href="?tpf=admin/menu/sitemap"><i class="fa fa-circle-o"></i> 하단 사이트맵 관리</a></li>
                    <li<?=!empty($arrMenuSub['menu']['link']) ? $arrMenuSub['menu']['link'] : ""?>><a href="?tpf=admin/menu/link"><i class="fa fa-circle-o"></i> 기존URL 관리</a></li>
                </ul>
            </li>
<?php
}
if ($arrAdminMenu['board'] == 'y') {
?>

            <li class="<?=@$arrMenu['board']?>treeview">
                <a href="#">
                <i class="fa fa-list-alt"></i> <span>게시판 관리</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['board']['manage']) ? $arrMenuSub['board']['manage'] : ""?>><a href="index.php?tpf=admin/board/manage"><i class="fa fa-circle-o"></i> 리스트</a></li>
<?php
if (!empty($arrBoard['list'])) {
    foreach($arrBoard['list'] as $key => $val) {
        if ($val['is_mass'] == 'y') $link = 'list_upload';
        else if ($val['is_order'] == 'y') $link = 'list_order';
        else $link = 'list';

        echo '      <li'; if(@$this->reqData['board_code'] == $val['code']) echo ' class="active"'; echo '><a href="index.php?tpf=admin/board/'.$link.'&board_code='.$val['code'].'"><i class="fa fa-circle-o"></i> '.$val['title'].'</a></li>';
    }
}
?>              </ul>
            </li>
<?php
}
if ($arrAdminMenu['product'] == 'y') {
?>
            <li class="<?=@$arrMenu['product']?>treeview">
                <a href="#">
                <i class="fa fa-gift"></i> <span>제품</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['product']['list']) ? $arrMenuSub['product']['list'] : ""?>><a href="?tpf=admin/product/list"><i class="fa fa-circle-o"></i> 리스트 </a></li>
                    <li<?=!empty($arrMenuSub['product']['item']) ? $arrMenuSub['product']['item'] : ""?>><a href="?tpf=admin/product/item"><i class="fa fa-circle-o"></i> 입력항목 설정 </a></li>
                    <!-- type 2 - product2 테이블사용
                    <li<?=!empty($arrMenuSub['product']['list2']) ? $arrMenuSub['product']['list2'] : ""?>><a href="?tpf=admin/product/list2"><i class="fa fa-circle-o"></i> 리스트 </a></li> -->
                    <li<?=!empty($arrMenuSub['product']['category']) ? $arrMenuSub['product']['category'] : ""?>><a href="?tpf=admin/product/category"><i class="fa fa-circle-o"></i> 카테고리 </a></li>
                </ul>
            </li>
<?php
}
if ($arrAdminMenu['member'] == 'y') {
?>
            <li class="<?=@$arrMenu['member']?>treeview">
                <a href="#">
                <i class="fa fa-user"></i> <span>회원 관리</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['member']['list']) ? $arrMenuSub['member']['list'] : ""?>><a href="?tpf=admin/member/list"><i class="fa fa-circle-o"></i> 회원 리스트</a></li>
                    <li<?=!empty($arrMenuSub['member']['withdraw_list']) ? $arrMenuSub['member']['withdraw_list'] : ""?>><a href="?tpf=admin/member/withdraw_list"><i class="fa fa-circle-o"></i> 탈퇴회원 리스트</a></li>
                    <li<?=!empty($arrMenuSub['member']['log']) ? $arrMenuSub['member']['log'] : ""?>><a href="?tpf=admin/member/log"><i class="fa fa-circle-o"></i> 회원 접속이력 관리</a></li>
                    <li<?=!empty($arrMenuSub['member']['level']) ? $arrMenuSub['member']['level'] : ""?>><a href="?tpf=admin/member/level"><i class="fa fa-circle-o"></i> 등급 관리</a></li>
                </ul>
            </li>
<?php
}
if ($arrAdminMenu['schedule'] == 'y') {
?>
            <li class="<?=@$arrMenu['schedule']?>">
                <a href="?tpf=admin/schedule/list">
                <i class="fa fa-calendar"></i> <span>일정 관리</span>
                </a>
            </li>
<?php
}
if ($arrAdminMenu['reservation'] == 'y') {
?>
            <li class="<?=@$arrMenu['meeting']?>treeview">
                <a href="#">
                <i class="fa fa-commenting"></i> <span>회의실 예약 관리</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['meeting']['meeting_room']) ? $arrMenuSub['meeting']['meeting_room'] : ""?>><a href="?tpf=admin/meeting/meeting_room"><i class="fa fa-circle-o"></i>회의실 리스트</a></li>
                    <li<?=!empty($arrMenuSub['meeting']['reservation']) ? $arrMenuSub['meeting']['reservation'] : ""?>><a href="?tpf=admin/meeting/reservation"><i class="fa fa-circle-o"></i>예약 리스트</a></li>
                </ul>
            </li>
<?php
}
if ($arrAdminMenu['form'] == 'y') {
?>
            <li class="<?=@$arrMenu['form']?>treeview">
                <a href="#">
                <i class="fa fa-check-square-o"></i> <span>폼메일 관리</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['form']['manage']) ? $arrMenuSub['form']['manage'] : ""?>><a href="index.php?tpf=admin/form/manage"><i class="fa fa-circle-o"></i> 리스트</a></li>
<?php
if (!empty($arrForm['list'])) {
    foreach($arrForm['list'] as $key => $val) {
        echo '      <li'; if(@$this->reqData['form_code'] == $val['code']) echo ' class="active"'; echo '><a href="index.php?tpf=admin/form/list&form_code='.$val['code'].'"><i class="fa fa-circle-o"></i> '.$val['title'].'</a></li>';
    }
}
?>
                </ul>
            </li>
<?php
}

if ($arrAdminMenu['community'] == 'y') {
?>

            <li class="<?=@$arrMenu['community']?>treeview">
                <a href="#">
                <i class="fa fa-commenting"></i> <span>커뮤니티 관리</span>  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li<?=!empty($arrMenuSub['community']['email']) ? $arrMenuSub['community']['email'] : ""?>><a href="?tpf=admin/community/email"><i class="fa fa-circle-o"></i>메일 설정</a></li>
                    <li<?=!empty($arrMenuSub['community']['email_list']) ? $arrMenuSub['community']['email_list'] : ""?>><a href="?tpf=admin/community/email_list"><i class="fa fa-circle-o"></i>메일 발송 내역</a></li>
                    <li<?=!empty($arrMenuSub['community']['sms']) ? $arrMenuSub['community']['sms'] : ""?><?=!empty($arrMenuSub['community']['sms_kakao']) ? $arrMenuSub['community']['sms_kakao'] : ""?>><a href="?tpf=admin/community/sms"><i class="fa fa-circle-o"></i>카카오알림톡 문구 지정</a></li>
                    <li<?=!empty($arrMenuSub['community']['sms_list']) ? $arrMenuSub['community']['sms_list'] : ""?>><a href="?tpf=admin/community/sms_list"><i class="fa fa-circle-o"></i>SMS 발송 내역</a></li>
                </ul>
            </li>
<?php
}
?>
            <li class="<?=@$arrMenu['setting']?>treeview">
                <a href="#">
                <i class="fa fa-gear"></i> <span>설정</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
<?php
if ($arrAdminMenu['popup'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['popup'])) echo $arrMenuSub['setting']['popup']; echo '><a href="?tpf=admin/setting/popup"><i class="fa fa-circle-o"></i> 팝업 관리</a></li>';}
if ($arrAdminMenu['map'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['map'])) echo $arrMenuSub['setting']['map']; echo '><a href="?tpf=admin/setting/map"><i class="fa fa-circle-o"></i> 약도 관리</a></li>';}
if ($arrAdminMenu['staff'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['staff'])) echo $arrMenuSub['setting']['staff']; echo '><a href="?tpf=admin/setting/staff"><i class="fa fa-circle-o"></i> 임원 관리</a></li>';}
if ($arrAdminMenu['history'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['history'])) echo $arrMenuSub['setting']['history']; echo '><a href="?tpf=admin/setting/history"><i class="fa fa-circle-o"></i> 연혁 관리</a></li>';}
if ($arrAdminMenu['banner'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['banner'])) echo $arrMenuSub['setting']['banner']; echo '><a href="?tpf=admin/setting/banner"><i class="fa fa-circle-o"></i> 배너 관리</a></li>';}
if ($arrAdminMenu['contract'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['contract'])) echo $arrMenuSub['setting']['contract']; echo '><a href="?tpf=admin/setting/contract"><i class="fa fa-circle-o"></i> 약관 관리</a></li>';}
if ($arrAdminMenu['delivery_company'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['delivery_company'])) echo $arrMenuSub['setting']['delivery_company']; echo '><a href="?tpf=admin/setting/delivery_company"><i class="fa fa-circle-o"></i> 택배사 관리</a></li>';}
if ($arrAdminMenu['info'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['info'])) echo $arrMenuSub['setting']['info']; echo '><a href="?tpf=admin/setting/info"><i class="fa fa-circle-o"></i> 기본 설정</a></li>';}
if ($arrAdminMenu['seo'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['seo'])) echo $arrMenuSub['setting']['seo']; echo '><a href="?tpf=admin/setting/seo"><i class="fa fa-circle-o"></i> SEO 설정</a></li>';}
if ($arrAdminMenu['snslogin'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['snslogin'])) echo $arrMenuSub['setting']['snslogin']; echo '><a href="?tpf=admin/setting/snslogin"><i class="fa fa-circle-o"></i> SNS 로그인 설정</a></li>';}
if ($arrAdminMenu['locale'] == 'y') { echo '<li'; if(!empty($arrMenuSub['setting']['locale'])) echo $arrMenuSub['setting']['locale']; echo '><a href="?tpf=admin/setting/locale"><i class="fa fa-circle-o"></i> 다국어 번역</a></li>';}
if (getLoginId() == 'admin') { echo '<li'; if(!empty($arrMenuSub['setting']['translation'])) echo $arrMenuSub['setting']['translation']; echo '><a href="?tpf=admin/setting/translation"><i class="fa fa-circle-o"></i> 컨텐츠 전체 복사&번역</a></li>';}
?>
                </ul>
            </li>
<?php
if (getLoginId() == 'admin') {
$version_info = $this->objDBH->getRow("select version,left(version,1) as v from version order by version desc");
    echo '  <li>
                <a href="?tpf=admin/setting/version&v='.$version_info['v'].'">
                <i class="fa fa-exclamation-circle"></i> <span>Version</span> <small class="label pull-right bg-green">'.$version_info['version'].'</small>
                </a>
            </li>';
}
?>
        </ul>
    </section>
</aside><!-- /.sidebar -->