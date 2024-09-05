<?php
$ads_tag = file_get_contents(_LIBRARY_DIR."/config/cfg.AdsTag.ini", true);
if (@$meta_title == NULL) {
    include(_LIBRARY_DIR."/config/meta.php");
	$canonical_url = @unserialize($canonical_orig)[getLocale()];
    $keyword = @unserialize($keyword_orig)[getLocale()];
    $meta_title = @unserialize($meta_title_orig)[getLocale()];
    $meta_description = @unserialize($meta_description_orig)[getLocale()];
}

if(empty($canonical_url)){
	$canonical_url = _HOME_URL;
}


    $meta_tags = '<meta name="author" content="'.$meta_title.'" />
    <meta name="keywords" content="'.$keyword.'" />
    <meta name="description" content="'.$meta_description.'" />
    <meta property="og:title" content="'.$meta_title.'">
    <meta property="og:url" content="'._HOME_URL.'">
    <meta property="og:image" content="'._HOME_URL.'/user/meta_logo.jpg?dummy='.getDummy().'">
    <meta property="og:description" content="'.$meta_description.'"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="'.$meta_title.'">
    <meta name="twitter:url" content="'._HOME_URL.'">
    <meta name="twitter:image" content="'._HOME_URL.'/user/meta_logo.jpg?dummy='.getDummy().'">
    <meta name="twitter:description" content="'.$meta_description.'"/>
    <link rel="canonical" href="'.$canonical_url.$_SERVER['REQUEST_URI'].'">
    <link rel="shortcut icon" href="/user/favicon">
    '.@$ads_tag.'
';
?>