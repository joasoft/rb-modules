<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_tmpdfile = $g['dir_module'].'var/var.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$d['marketv2']['url'] = \"".$url."\";\n");
fwrite($fp, "\$d['marketv2']['id'] = \"".$id."\";\n");
fwrite($fp, "\$d['marketv2']['pw'] = \"".$pw."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);


getLink('reload','parent.','입력하신 내용이 적용되었습니다.','');
?>