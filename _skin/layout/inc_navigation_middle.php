<!-- 서브 네비게이션 -->
<?php
include(_LIBRARY_DIR."/config/menu.php");
$arrUrl = explode('/', preg_replace('/^\//','',@$this->reqData['url']));
?>

<section class="location-wrap">
<div class="inner">
<ul class="location-ul">
<?php
// 1차 카테고리
if (!empty($arrCategory[1])) {
    echo '
    <li class="location-home"><a href="/"><img src="/html/_skin/img/common/ico_home.png" alt="Go HOME"></a></li>
    <li>
        <a href="#">'.unserialize(@$arrNav[$arrCategory[1]]['title'])[$locale].'</a>
        <ul class="location-depth2">';
foreach($arrNav as $key => $val) {
    $val['title'] = unserialize($val['title'])[$locale];
    $val['status'] = unserialize($val['status'])[$locale];
    if (!empty($val['title']) and $val['status'] == 'y') {
        echo '  <li'; if($arrCategory[1] == $key) { echo ' class="on"';} echo '>';
        if($val['is_outer_link'] == 'n') echo '<a href="'.$prefix_link.'/'.$val['url'].'">'.$val['title'].'</a><!-- 1차 -->';
        else echo '<a href="'.$val['url'].'" target="'.$val['target'].'"">'.$val['title'].'</a><!-- 1차 -->';
        echo '  </li>';
    }
}
    echo '
        </ul>
    </li>';
}

// 2차 카테고리
if (!empty($arrNav[$arrCategory[1]]['sub'])) {
    $menu_title = unserialize(@$arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['title'])[$locale];
    if ($menu_title == '') $menu_title = unserialize(@$arrNav[$arrCategory[1]]['title'])[$locale];
    echo '
    <li>
        <a href="#">'.$menu_title.'</a>
        <ul class="location-depth2">';

$index = 1;
foreach($arrNav[$arrCategory[1]]['sub'] as $key => $val) {
    $val['title'] = unserialize($val['title'])[$locale];
    $val['status'] = unserialize($val['status'])[$locale];
    if (!empty($val['title']) and $val['status'] == 'y') {
        echo '  <li'; if((empty($arrUrl[1]) and $index == 1) or @$arrUrl[1] == $val['url']) { echo ' class="on"';} echo '>';
        if($val['is_outer_link'] == 'n') echo '<a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a><!-- 2차 -->';
        else echo '  <a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a><!-- 2차 -->';  // 외부링크 일때
        echo '  </li>';
    }
    $index++;
}
    echo '
        </ul>
    </li>';
}

// 3차 카테고리
if (!empty($arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'])) {
    $menu_title = unserialize(@$arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'][$arrCategory[3]]['title'])[$locale];
    if ($menu_title == '') $menu_title = unserialize(@$arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['title'])[$locale];
    echo '
    <li>
        <a href="#">'.$menu_title.'</a>
        <ul class="location-depth2">';

$index = 1;
foreach($arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'] as $key => $val) {
    $val['title'] = unserialize($val['title'])[$locale];
    $val['status'] = unserialize($val['status'])[$locale];
    if (!empty($val['title']) and $val['status'] == 'y') {
        echo '  <li'; if((empty($arrUrl[1]) and $index == 1) or @$arrUrl[1] == $val['url']) { echo ' class="on"';} echo '>';
        if($val['is_outer_link'] == 'n') echo '<a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a><!-- 2차 -->';
        else echo '  <a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a><!-- 2차 -->';  // 외부링크 일때
        echo '  </li>';
    }
    $index++;
}
    echo '
        </ul>
    </li>';
}

// 4차 카테고리
if (!empty($arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'][$arrCategory[3]]['sub'])) {
    $menu_title = unserialize(@$arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'][$arrCategory[3]]['sub'][$arrCategory[4]]['title'])[$locale];
    if ($menu_title == '') $menu_title = unserialize(@$arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'][$arrCategory[3]]['title'])[$locale];
    echo '
    <li>
        <a href="#">'.$menu_title.'</a>
        <ul class="location-depth2">';

$index = 1;
foreach($arrNav[$arrCategory[1]]['sub'][$arrCategory[2]]['sub'][$arrCategory[3]]['sub'] as $key => $val) {
    $val['title'] = unserialize($val['title'])[$locale];
    $val['status'] = unserialize($val['status'])[$locale];
    if (!empty($val['title']) and $val['status'] == 'y') {
        echo '  <li'; if((empty($arrUrl[1]) and $index == 1) or @$arrUrl[1] == $val['url']) { echo ' class="on"';} echo '>';
        if($val['is_outer_link'] == 'n') echo '<a href="'.$prefix_link.'/'.$val['full_url'].'">'.$val['title'].'</a><!-- 2차 -->';
        else echo '  <a href="'.$val['url'].'" target="'.$val['target'].'">'.$val['title'].'</a><!-- 2차 -->';  // 외부링크 일때
        echo '  </li>';
    }
    $index++;
}
    echo '
        </ul>
    </li>';
}
?>
	</ul>
	</div>
</section>