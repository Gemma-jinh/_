<?php
// 1차 메뉴만 표출

include(_LIBRARY_DIR."/config/menu.php");
if($locale != getDefaultLocale()) $arrUrl = explode('/', preg_replace('/'.$locale.'\//','',@$_GET['url']));
$arrSubMenu = @$arrNav[substr(@$category_code,0,2)]['sub'];

if (!empty(@$arrSubMenu) and !preg_match('/index.php\?tpf=shop/',$_SERVER['REQUEST_URI'])) {
?>
<div class="subCommon--fc">
	<div class="inner">
    <h2 class="ce_item"><?=unserialize(@$arrSubMenu[substr(@$category_code,0,4)]['title'])[getLocale()]?></h2>
<?php
// 2차 카테고리
if (!empty($arrSubMenu[substr(@$category_code,0,4)]['sub'])) {
    echo '
    <div class="cateBox ce_item">
        <ul class="category_list--fc">';
    $index = 1;
    foreach($arrSubMenu[substr(@$category_code,0,4)]['sub'] as $key => $val) {
        $val['title'] = unserialize($val['title'])[getLocale()];
        $val['status'] = unserialize($val['status'])[getLocale()];
        if (!empty($val['title']) and $val['status'] == 'y') {
            if ((empty($arrUrl[1]) and $index == 1) or @$arrUrl[2] == $val['url']) {
                $on_class="class='on'";
                if($val['is_outer_link'] == 'n') echo '<li '.$on_class.'><a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a></li>';
                else echo '  <li '.$on_class.'><a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a></li>';  // 외부링크 일때
            } else {
                if($val['is_outer_link'] == 'n') echo '<li><a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a></li>';
                else echo '  <li><a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a></li>';  // 외부링크 일때
            }
        }
        $index++;
    }
    echo '
        </ul>
    </div>';
}
?>
	</div>
</div>

<script>
var lengthValue = $("#leftMenu ul li").length;
var cssWidthValue = 100 / lengthValue;
$("#leftMenu ul li").css('width',cssWidthValue+"%");
</script>
<?php
}
?>