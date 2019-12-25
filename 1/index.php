<?php

// \f\pa($_POST, 2);
// \f\pa($_FILES,2);

if (!empty($_POST['add_new_item'])) {

    \f\pa($_POST);
    
    $dd = $_POST['f'];
    $dd['catalog'] = max($_POST['cat']);

//    \f\pa($dd);

    $rr = \Nyos\mod\ShopBu::addNewItem($db, $dd, $_FILES['files']);
//     \f\pa($rr);
    
}

// \Nyos\mod\items::$get_data_simple = true;
// $items = \Nyos\mod\items::getItemsSimple($db, 'tovars');
// $items = \Nyos\mod\items::getItemsSimple3($db, 'tovars');
// \f\pa($items);

$vv['tpl_body'] = ( file_exists(dir_site_module_nowlev_tpl . 'body.htm') ? dir_site_module_nowlev_tpl . 'body.htm' : dir_mods_mod_vers_tpl . 'body.htm' );

//f\pa($vv['now_mod']);

//\f\pa($_POST);
// \f\pa($_GET);

//if (isset($vv['now_mod']['no_cats']{1})) {
//    $vv['tpl_0body'] = \f\like_tpl('sh-no.cat', $vv['dir_module_tpl'], $vv['dir_site_tpl']);
//} else {
    // $vv['body'] = \f\like_tpl('sh', $vv['dir_module_tpl'], $vv['dir_site_tpl']);
//}

//echo 
//$vv['tpl_body'] = dir_site_module_nowlev_tpl.'body.htm';

