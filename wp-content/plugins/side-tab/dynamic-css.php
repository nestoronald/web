<?php

/**
 * @author trungvan
 * @copyright 2010
 */
header('Content-type: text/css'); 
$path=explode("wp-content",$_SERVER['SCRIPT_FILENAME']);
$realpath=array_shift($path);


require_once( $realpath.'/wp-load.php');

$Sidetab_newOptions = get_option('Sidetab_options');
$color1=$Sidetab_newOptions['tabcolor']?$Sidetab_newOptions['tabcolor']:'#000000';
$tabs=$Sidetab_newOptions['tabs'];

$top1=20;
echo '#side-bar1 .tab{top:20px;}';
//echo '#side-bar1 .drawer{top:0px;}';  
for($i=1;$i<=$tabs;$i++){
    $len=strlen($Sidetab_newOptions['tabtext'.($i-1)]);    
    $top{$i}= $top{$i-1}+$len*14+20;
    echo '#side-bar'.$i.' .tab{top:'.$top{$i}.'px;}';
    
    $color{$i}=$Sidetab_newOptions['tabcolor'.$i];
    $textcolor{$i}=$Sidetab_newOptions['tabcolortext'.$i];
    echo '#drawer_content_'.$i.' {width:163px;}';
    echo '#side-bar'.$i.' .tab{background:'.$color{$i}.';}';
    echo '#side-bar'.$i.' .drawer_content{background:'.$color{$i}.';}';
    echo '#side-bar'.$i.' .drawer{color :'.$textcolor{$i}.' !important;}';
    echo '#side-bar'.$i.' .drawer a{color :'.$textcolor{$i}.' !important;}';
    echo '#side-bar'.$i.' .drawer a{color :'.$textcolor{$i}.' !important;}';
    echo '#side-bar'.$i.' .drawer span{color :'.$textcolor{$i}.' !important;}';
}
?>