<?php 
include $g['path_module'].$module.'/var/var.php';
if($d['marketv2']['url']):
include $g['path_core'].'function/rss.func.php';
$marketData = getUrlData($d['marketv2']['url'].'&iframe=Y&page=client.front.mobile&_clientu='.$g['s'].'&_clientr='.$r.'&cat='.$cat.'&theme='.$theme.'&sort='.$sort.'&orderby='.$orderby.'&type='.$type.'&ptype='.$ptype.'&p='.$p.'&todayfree='.$todayfree.'&sailing='.$sailing.'&where='.'name|tag'.'&keyword='.'확장'.'&brand='.$brand.'&id='.$d['marketv2']['id'].'&pw='.$d['marketv2']['pw'],10);
$marketData = explode('[RESULT:',$marketData);
$marketData = explode(':RESULT]',$marketData[1]);
$marketData = $marketData[0];
echo $marketData;
else:?>
<div class="noconfig">
<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=config">마켓 접속주소를 등록해 주세요.</a>
</div>
<?php endif?>