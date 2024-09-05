<?php
// 하위 tree 모양 표출

include(_LIBRARY_DIR."/config/menu.php");
if($locale != getDefaultLocale()) $arrUrl = explode('/', preg_replace('/'.$locale.'\//','',@$_GET['url']));
$cf_one_title = @$arrNav[substr(@$category_code,0,2)]['title'];
$cf_one_title = unserialize($cf_one_title)[getLocale()];
$arrSubMenu = @$arrNav[substr(@$category_code,0,2)]['sub'];
//if(getenv("REMOTE_ADDR") == "175.198.83.198") { echo "<div align=left><pre>"; var_dump($arrSubMenu); echo "</pre>"; die("<br>End</div>");}
if(!empty(@$arrNav[substr($category_code,0,2)]['sub'][substr($category_code,0,4)]['sub'])) { // 3depth
    $cf_title_txt = unserialize(@$arrNav[substr($category_code,0,2)]['sub'][substr($category_code,0,4)]['sub'][substr($category_code,0,6)]['title'])[getLocale()];
}else if(!empty(@$arrNav[substr($category_code,0,2)]['sub'])) { // 2depth
    $cf_title_txt = unserialize(@$arrNav[substr($category_code,0,2)]['sub'][substr($category_code,0,4)]['title'])[getLocale()];
} else { // 1depth
   $cf_title_txt = unserialize(@$arrNav[substr($category_code,0,2)]['title'])[getLocale()];
}
if (!empty(@$arrSubMenu) and !preg_match('/index.php\?tpf=shop/',$_SERVER['REQUEST_URI'])) {
?>

<div class="subCommon--fc">
	<div class="">
    <h2 class="ce_item"><?=@$cf_one_title?></h2>
<?php
// 2차 카테고리
//if(getenv("REMOTE_ADDR") == "175.198.83.198") { echo "<div align=left><pre>"; var_dump($arrNav); echo "</pre>"; die("<br>End</div>");}
if (!empty($arrNav[substr(@$category_code,0,2)]['sub'])) { // 2depth 가 있을경우 표출
    echo '
    <div class="cateBox ce_item" style="z-index:1">
        <ul class="category_list--fc" style="height:80px;">';
    $index = 1;
    foreach($arrNav[substr(@$category_code,0,2)]['sub'] as $key => $val) {
        $val['title'] = unserialize($val['title'])[getLocale()];
        $val['status'] = unserialize($val['status'])[getLocale()];
        if (!empty($val['title']) and $val['status'] == 'y') {
            if ((empty($arrUrl[1]) and $index == 1) or @$arrUrl[1] == $val['url']) {
                $on_class="on";
				if (!empty($arrSubMenu[$key]['sub'])) {
					$has_children="page_item_has_children";
				} else {
					$has_children="";
				}
            }
            else {
                $on_class = '';
                $has_children="";
            }
        }
            if($val['is_outer_link'] == 'n') {
                echo '<li class=" '.$on_class.' '.$has_children.'"">
                        <a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a>';
                    if (!empty($arrSubMenu[$key]['sub'])) { // 3depth 가 있을경우
                        echo' <ul class="children">';
                            $index = 1;
                            foreach($arrSubMenu[$key]['sub'] as $key2 => $val2) {
                                $val2['title'] = unserialize($val2['title'])[getLocale()];
                                $val2['status'] = unserialize($val2['status'])[getLocale()];
                                if (!empty($val2['title']) and $val2['status'] == 'y') {
                                    if ((empty($arrUrl[1]) and $index == 1) or @$arrUrl[2] == $val2['url']) {
                                        $on_class="on";
                                        if (!empty($arrSubMenu[$key]['sub'][$key2]['sub'])) { // 4depth 가 있을경우
                                            $has_children="page_item_has_children";
                                        } else {
                                            $has_children="";
                                        }
                                    }
                                    else {
                                        $on_class = '';
                                        $has_children="";
                                    }

                                    if($val2['is_outer_link'] == 'n') {
                                        echo '<li class="page_item '.$on_class.' '.$has_children.'">
                                                <a href="'.$prefix_link.'/'.$val2['full_url'].'">'.$val2['title'].'</a>';
                                        if (!empty($arrSubMenu[$key]['sub'][$key2]['sub'])) { // 4depth 가 있을경우
                                            echo' <ul class="children">';
                                                $index = 1;
                                                foreach($arrSubMenu[$key]['sub'][$key2]['sub'] as $key3 => $val3) {
                                                    $val3['title'] = unserialize($val3['title'])[getLocale()];
                                                    $val3['status'] = unserialize($val3['status'])[getLocale()];
                                                    if (!empty($val3['title']) and $val3['status'] == 'y') {
                                                        if ((empty($arrUrl[1]) and $index == 1) or @$arrUrl[3] == $val3['url']) {
                                                            $on_class="on";
                                                        }
                                                        else {
                                                            $on_class = '';
                                                        }
                                                        echo '<li class="page_item '.$on_class.'"><a href="'.$prefix_link.'/'.$val3['full_url'].'">'.$val3['title'].'</a></li>';
                                                    }
                                                }
                                            echo'   </ul>';
                                        }
                                        echo '</li>';
                                    }
                                    else {
                                        echo '  <li class="page_item '.$on_class.' '.$has_children.'"><a href="'.$val2['url'].'" target="'.$val2['target'].'">'.$val2['title'].'</a></li>';  // 외부링크 일때
                                    }
                                }
                                $index++;
                            }
                        echo'</ul>';
                    }

                echo' </li>';
            }
            else {
                echo '  <li class=" '.$on_class.' '.$has_children.'"><a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a></li>'; // 외부링크 일때
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