<?php

/**
  определение функций для TWIG
 */
//creatSecret
// $function = new Twig_SimpleFunction('creatSecret', function ( string $text ) {
//    return \Nyos\Nyos::creatSecret($text);
// });
// $twig->addFunction($function);



$function = new Twig_SimpleFunction('getShopLevel', function () {

    \Nyos\Nyos::getSiteModule();

    //\f\pa($e);
    // \f\pa(\Nyos\Nyos::$all_menu);
    // \f\pa(\Nyos\Nyos::$a_menu);

    foreach (\Nyos\Nyos::$all_menu as $k => $v) {
        if (isset($v['type']) && $v['type'] == 'shop_bu') {
            return $k;
        }
    }

    return false;
});
$twig->addFunction($function);








$function = new Twig_SimpleFunction('shop_bu__searchNavCatalogId', function ( $db, $cat_id ) {
    
    
    $cats = \Nyos\mod\ShopBu::searchNavCatalogId($db,$cat_id);
    // \f\pa($cats);
    
    return $cats;
    return false;
});
$twig->addFunction($function);








$function = new Twig_SimpleFunction('shop_bu__get_items', function ( $db, $get ) {

    // \f\pa($get);
    // \Nyos\mod\items::$get_data_simple = true;
    // $cats = \Nyos\mod\items::getItemsSimple($db, 'catalogs');
    $cats = \Nyos\mod\items::getItemsSimple3($db, 'catalogs');
    // \f\pa($cats,'','','cats');

    $gg = $_GET['ext5'] ?? $_GET['ext4'] ?? $_GET['ext3'] ?? $_GET['ext2'] ?? $_GET['ext1'] ?? 0;

    // \f\pa($gg);
    if ($gg == 0) {


        $tovars = \Nyos\mod\items::getItemsSimple3($db, 'tovars', 'show', 'desc_id');
        //\f\pa($tovars, 2);

        $show_items = [];

        $wer = 0;

        foreach ($tovars as $k => $v) {

            if ($wer >= 30) {
                break;
            }
            
            if( !empty($v['catalog']) ){
            $show_items[] = $v;
            $wer++;
            }
        }
        
    } else {

        $array = null;

        foreach ($cats as $k => $v) {
            if (isset($v['head_translit']) && $v['head_translit'] == $gg) {
                $array = $v;
                break;
            }
        }





        // \f\pa($array,'','','array');
        // \Nyos\mod\items::$get_data_simple = true;
        // \Nyos\mod\items::$show_sql = true;
        // $tovars = \Nyos\mod\items::getItemsSimple($db, 'tovars', 'show', 'desc_id');
        $tovars = \Nyos\mod\items::getItemsSimple3($db, 'tovars', 'show', 'desc_id');
        //\f\pa($tovars, 2);

        $show_items = [];

        $wer = 0;

        foreach ($tovars as $k => $v) {

            // \f\pa($v);
            if ($array === null) {
                if ($wer >= 30) {
                    break;
                }
                $show_items[] = $v;
            }

            if (isset($v['catalog']) && $v['catalog'] == $array['id']) {
                // \f\pa($v);
                $show_items[] = $v;
            }

            $wer++;
        }
    }
    return $show_items;
});
$twig->addFunction($function);








$function = new Twig_SimpleFunction('shop_bu__get_item', function ( $db, $get ) {

    if (!empty($get['ext1']) && is_numeric($get['ext1'])) {
        
    } else {
        return false;
    }

    // \Nyos\mod\items::$join_where = ' INNER JOIN `mitems-dops` mid1 ON mid1.id_item = mi.id AND mid1.name = \'\' ';
    \Nyos\mod\items::$where2 = ' AND `mi`.`id` = ' . $get['ext1'] . ' ';
    $item = \Nyos\mod\items::getItemsSimple3($db, 'tovars');

    // \f\pa($item);
    return ( $item[$get['ext1']] ?? false );
});
$twig->addFunction($function);
