<?
   function getUpfiles($code) 
   { 
    global $DB_CONNECT; 
    
    $exp = explode(']',str_replace('[','',trim($code)));
    $len = count($exp);
    $j=0;
    for ($i = 0; $i < $len; $i++)
    {
     if(!$exp[$i]) continue;
     $UP=db_query("select * from rb_s_upload where uid='".$exp[$i]."'".($type>0?" and type=2''":""),$DB_CONNECT);
     while($U=db_fetch_array($UP))
     {
      $upload[$j] = $U;
      $j++;
     }
    } 
    return $upload; 
   }
   ?>
   <div id="bbsview">

	<div class="viewbox">

		<div class="icon hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>

		<div class="subject">
			<h1><?php echo $R['subject']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
				<?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?> <span class="split">|</span> 
				<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> 
				<?php if($d['theme']['show_score1']):?><span class="split">|</span> <span class="han">공감</span> <span class="num"><?php echo $R['score1']?></span> <?php endif?>
				<?php if($d['theme']['show_score2']):?><span class="split">|</span> <span class="han">비공감</span> <span class="num"><?php echo $R['score2']?></span> <?php endif?>
			</div>
			<div class="xright">
				<ul>
				<?php if($d['theme']['use_singo']):?>
				<li class="g"><a href="<?php echo $g['bbs_action']?>singo&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?');"><img src="<?php echo $g['img_core']?>/_public/b_cop.gif" alt="신고" title="신고" />신고</a></li>
				<?php endif?>
				<?php if($d['theme']['use_print']):?>
				<li class="g"><a href="javascript:printWindow('<?php echo $g['bbs_print'].$R['uid']?>');"><img src="<?php echo $g['img_core']?>/_public/b_print.gif" alt="인쇄" title="인쇄" />인쇄</a></li>
				<?php endif?>
				<?php if($d['theme']['use_scrap']):?>
				<li class="g"><a href="<?php echo $g['bbs_action']?>scrap&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return isLogin();"><img src="<?php echo $g['img_core']?>/_public/b_scrap.gif" alt="스크랩" title="스크랩" />스크랩</a></li>
				<?php endif?>
				<?php if($d['theme']['use_font']):?>
				<li><div id="fontface"></div><img src="<?php echo $g['img_core']?>/_public/b_font.gif" alt="글꼴" title="글꼴" class="hand" onclick="fontFace('vContent','fontface');" /></li>
				<li><img src="<?php echo $g['img_core']?>/_public/b_plus.gif" alt="확대" title="확대" class="hand" onclick="fontResize('vContent','+');"/></li>
				<li><img src="<?php echo $g['img_core']?>/_public/b_minus.gif" alt="축소" title="축소" class="hand" onclick="fontResize('vContent','-');" /></li>
				<?php endif?>
				</ul>
			</div>
		</div>


		<div id="vContent" class="content">

<div style="margin-bottom:10px;"><img src="<?=$g['img_module_skin']?>/icon002.gif" /> <strong>기본정보</strong></div>
<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:10px 10px 10px 10px;">
	<?php $adddata_exp=explode("|" , $R['adddata'])?>
	<?php $add_txt1_exp=explode("|" , $R['add_txt1'])?>
	<?php $add_txt2_exp=explode("|" , $R['add_txt2'])?>
	<?php $add_txt3_exp=explode("|" , $R['add_txt3'])?>
	<?php $add_txt4_exp=explode("|" , $R['add_txt4'])?>
	<?php $add_txt5_exp=explode("|" , $R['add_txt5'])?>

	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<?php $_thumbimg=getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],'jpg|jpeg|gif|GIF')?>
	<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_module_skin'].'/no_img1.gif'?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="310" height="150" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><SCRIPT LANGUAGE="JavaScript">
<!--
function callme<?=$R['uid']?>(image) {
img<?=$R['uid']?>.filters[0].Apply();
img<?=$R['uid']?>.src=image;
img<?=$R['uid']?>.filters[0].Play();
}
//-->
      </SCRIPT>
        <div style="background:#ffffff;border:solid 1px #dfdfdf;padding:5px 5px 5px 5px;"><img src="<?php echo $_thumbimg?>" alt="" width="310" height="206" border="0" id="img<?=$R['uid']?>" style='filter:progid:DXImageTransform.Microsoft.Fade(duration=1.0,overlap=1.0)'/></div></td>
  </tr>
  <tr>
    <td><table>
        <tr align="center">
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?$UPIMG=getUpfiles($R['upload'])?>
              <?if($UPIMG[0]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[0]['folder'].'/'.$UPIMG[0]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[0]['folder'].'/'.$UPIMG[0]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[1]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[1]['folder'].'/'.$UPIMG[1]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[1]['folder'].'/'.$UPIMG[1]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[2]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[2]['folder'].'/'.$UPIMG[2]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[2]['folder'].'/'.$UPIMG[2]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[3]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[3]['folder'].'/'.$UPIMG[3]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[3]['folder'].'/'.$UPIMG[3]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[4]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[4]['folder'].'/'.$UPIMG[3]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[4]['folder'].'/'.$UPIMG[4]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
        </tr>
        <tr align="center">
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?$UPIMG=getUpfiles($R['upload'])?>
              <?if($UPIMG[0]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[5]['folder'].'/'.$UPIMG[5]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[5]['folder'].'/'.$UPIMG[5]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[1]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[6]['folder'].'/'.$UPIMG[6]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[6]['folder'].'/'.$UPIMG[6]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[2]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[7]['folder'].'/'.$UPIMG[7]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[7]['folder'].'/'.$UPIMG[7]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[3]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[8]['folder'].'/'.$UPIMG[8]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[8]['folder'].'/'.$UPIMG[8]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
          <td width="20%"><div style="width:54px;background:#ffffff;border:solid 1px #dfdfdf;padding:2px 2px 2px 2px;">
              <?if($UPIMG[4]):?>
              <img src="<?=$QURL['upload'].'files/'.$UPIMG[9]['folder'].'/'.$UPIMG[9]['tmpname']?>" alt="" width="50" height="50" border="0" onMouseOver="callme<?=$R['uid']?>('<?=$QURL['upload'].'files/'.$UPIMG[9]['folder'].'/'.$UPIMG[9]['tmpname']?>')"/>
              <?else:?>
              <img src="<?php echo $_thumbimg2?>" alt="" width="50" height="50" border="0" />
              <?endif?>
          </div></td>
        </tr>
    </table></td>
  </tr>
</table></td>
      <td width="10"></td>
      <td valign="top"><div style="background:#ffffff;border:solid 1px #dfdfdf;padding:8px 8px 8px 8px;">
         <table class="bbs-view mgb20">
    <colgroup>
    <col style="width:90px;" />
    <col style="width:100px;" />
	<col style="width:90px;" />
    <col />
    </colgroup>
    <tbody>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 주소</th>
        <td colspan="3"><?=$add_txt1_exp[2]?> <?=$add_txt1_exp[3]?> </td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 대표번호</th>
        <td colspan="3"><?php echo $add_txt2_exp[0]?> - <?php echo $add_txt2_exp[1]?> - <?php echo $add_txt2_exp[2]?></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 영업시간</th>
        <td colspan="3">영업시간 <?php if($R['add_int1'] == 1):?>
00 : 00
<?php elseif($R['add_int1']  == '2'):?>
00 : 01
<?php elseif($R['add_int1']  == '3'):?>
00 : 02
<?php elseif($R['add_int1']  == '4'):?>
00 : 03
<?php elseif($R['add_int1']  == '5'):?>
00 : 04
<?php elseif($R['add_int1']  == '6'):?>
00 : 05
<?php elseif($R['add_int1']  == '7'):?>
00 : 06
<?php elseif($R['add_int1']  == '8'):?>
00 : 07
<?php elseif($R['add_int1']  == '9'):?>
00 : 08
<?php elseif($R['add_int1']  == '10'):?>
00 : 09
<?php elseif($R['add_int1']  == '11'):?>
00 : 10
<?php elseif($R['add_int1']  == '12'):?>
00 : 11
<?php elseif($R['add_int1']  == '13'):?>
00 : 12
<?php elseif($R['add_int1']  == '14'):?>
00 : 13
<?php elseif($R['add_int1']  == '15'):?>
00 : 14
<?php elseif($R['add_int1']  == '16'):?>
00 : 15
<?php elseif($R['add_int1']  == '17'):?>
00 : 16
<?php elseif($R['add_int1']  == '18'):?>
00 : 17
<?php elseif($R['add_int1']  == '19'):?>
00 : 18
<?php elseif($R['add_int1']  == '20'):?>
00 : 19
<?php elseif($R['add_int1']  == '21'):?>
00 : 20
<?php elseif($R['add_int1']  == '22'):?>
00 : 21
<?php elseif($R['add_int1']  == '23'):?>
00 : 22
<?php elseif($R['add_int1']  == '24'):?>
00 : 23

<?php endif?>

~

마감시간
<?php if($R['add_int2'] == 1):?>
00 : 00
<?php elseif($R['add_int2']  == '2'):?>
00 : 01
<?php elseif($R['add_int2']  == '3'):?>
00 : 02
<?php elseif($R['add_int2']  == '4'):?>
00 : 03
<?php elseif($R['add_int2']  == '5'):?>
00 : 04
<?php elseif($R['add_int2']  == '6'):?>
00 : 05
<?php elseif($R['add_int2']  == '7'):?>
00 : 06
<?php elseif($R['add_int2']  == '8'):?>
00 : 07
<?php elseif($R['add_int2']  == '9'):?>
00 : 08
<?php elseif($R['add_int2']  == '10'):?>
00 : 09
<?php elseif($R['add_int2']  == '11'):?>
00 : 10
<?php elseif($R['add_int2']  == '12'):?>
00 : 11
<?php elseif($R['add_int2']  == '13'):?>
00 : 12
<?php elseif($R['add_int2']  == '14'):?>
00 : 13
<?php elseif($R['add_int2']  == '15'):?>
00 : 14
<?php elseif($R['add_int2']  == '16'):?>
00 : 15
<?php elseif($R['add_int2']  == '17'):?>
00 : 16
<?php elseif($R['add_int2']  == '18'):?>
00 : 17
<?php elseif($R['add_int2']  == '19'):?>
00 : 18
<?php elseif($R['add_int2']  == '20'):?>
00 : 19
<?php elseif($R['add_int2']  == '21'):?>
00 : 20
<?php elseif($R['add_int2']  == '22'):?>
00 : 21
<?php elseif($R['add_int2']  == '23'):?>
00 : 22
<?php elseif($R['add_int2']  == '24'):?>
00 : 23

<?php endif?></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 휴무일</th>
        <td colspan="3"><?php if($R['add_int3'] == 1):?>
월요일
<?php elseif($R['add_int3']  == '2'):?>
화요일
<?php elseif($R['add_int3']  == '3'):?>
수요일
<?php elseif($R['add_int3']  == '4'):?>
목요일
<?php elseif($R['add_int3']  == '5'):?>
금요일
<?php elseif($R['add_int3']  == '6'):?>
토요일
<?php elseif($R['add_int3']  == '7'):?>
일요일
<?php elseif($R['add_int3']  == '8'):?>
연중무휴
<?php endif?></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 주차대수</th>
        <td><?=$add_txt3_exp[0]?> 대</td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 카드여부</th>
        <td><?php if($R['add_int4'] == 1):?>
사용가능
<?php elseif($R['add_int4']  == '2'):?>
불가능
<?php endif?></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 좌석수</th>
        <td><?=$add_txt3_exp[1]?> 개</td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 흡연여부</th>
        <td><?php if($R['add_int5'] == 1):?>
흡연가능
<?php elseif($R['add_int5']  == '2'):?>
비흡연전용
<?php elseif($R['add_int5']  == '3'):?>
흡연전용석
<?php endif?></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 배달여부</th>
        <td><?php if($R['add_int6'] == 1):?>
상시배달가능
<?php elseif($R['add_int6']  == '2'):?>
시간대가능
<?php elseif($R['add_int6']  == '3'):?>
불가능
<?php endif?></td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 예약여부</th>
        <td><?php if($R['add_int7'] == 1):?>
예약가능
<?php elseif($R['add_int7']  == '2'):?>
불가능
<?php endif?></td>
      </tr>
	  <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 옵션</th>
        <td colspan="3"><?php if($add_txt5_exp[0] == 1):?>
<IMG alt="무료주차" src="<?=$g['img_module_skin']?>/icons_mini_11.gif">
<?php endif?>

<?php if($add_txt5_exp[1] == 2):?>
<IMG alt="24시간 오픈 아님" src="<?=$g['img_module_skin']?>/icons_mini_02.gif"> 
<?php endif?>

<?php if($add_txt5_exp[2] == 3):?>
<IMG alt="배달불가" src="<?=$g['img_module_skin']?>/icons_mini_03.gif">
<?php endif?>

<?php if($add_txt5_exp[3] == 4):?>
<a href="<?php echo $add_txt4_exp[0]?>" target="_blank"><IMG src="<?=$g['img_module_skin']?>/icons_mini_04.gif" alt="홈페이지" border="0"></a> 
<?php endif?>

<?php if($add_txt5_exp[4] == 5):?>
<IMG alt="진행중인 이벤트" src="<?=$g['img_module_skin']?>/icons_mini_06.gif">
<?php endif?></td>
      </tr>
    </tbody>
  </table> </div>
  
  <div style="margin-top:10px;height:34px;background:#ffffff;border:solid 1px #dfdfdf;padding:10px 10px 10px 10px;">
  <?php echo $R['add_txt6']?>
  </div>
  </td>
    </tr>
  </table>
</div>



<div style="margin-top:20px; margin-bottom:10px;"><img src="<?=$g['img_module_skin']?>/icon002.gif" /> <strong>찾아오시는길<?php echo $addr?></strong></div>
<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:8px 8px 8px 8px;"><!-- naver 지도API -->
	<?php echo
	$addr = ($adddata_exp[2])?str_replace(" ","",$adddata_exp[2])."".str_replace(" ","",$adddata_exp[3]):"서울시서초구서초동1364-29";
	$map_width = '650';
	$map_height = '500';
	$yzoom = '1';
	?>
	<?
global $R,$map_width,$map_height,$uid,$mid,$addr,$yzoom;
/************************************************************
* 이 플러그인은 naver-api 2.0 를 이용해 제작되었습니다.
* http://dev.naver.com/openapi/tutorial -> http://dev.naver.com/openapi/apis/map/javascript
* by redblock.co.kr 2009.1.12
************************************************************/
$addr = ($addr)?$addr:"서울시서초구서초동1364-29";
$map_width = ($map_width)?$map_width:'550';
$map_height = ($map_height)?$map_height:'650';
$yzoom = ($yzoom)?$yzoom:'0';
$wdate = dirname(__FILE__)."/date/";
$wdate_url = "http://".$_SERVER[HTTP_HOST].str_replace($_SERVER[DOCUMENT_ROOT],"",dirname(__FILE__));


//euckr->utf8
function getUTF_8($str)
{
	return iconv('EUC-KR','UTF-8',$str);
}

//utf8->euckr
function getEUC_KR($str)
{
	return iconv('UTF-8','EUC-KR',$str);
}

function getnavermapXml2($navermapxml_url,&$ygeopoint_x,&$ygeopoint_y){
	$pquery = $navermapxml_url;
	$fp = fsockopen ("maps.naver.com", 80, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno)";
	} else {
		fputs($fp, "GET /api/geocode.php?");
		fputs($fp, $pquery);
		fputs($fp, " HTTP/1.1\r\n");
		fputs($fp, "Host: maps.naver.com\r\n");
		fputs($fp, "Connection: Close\r\n\r\n");

		$header = "";
		while (!feof($fp)) {
			$out = fgets ($fp,512);
			if (trim($out) == "") {
				break;
			}
			$header .= $out;
		}

		$mapbody = "";
		while (!feof($fp)) {
			$out = fgets ($fp,512);
			$mapbody .= getUTF_8($out);
		}

		$idx = strpos(strtolower($header), "transfer-encoding: chunked");

		if ($idx > -1) { // chunk data
			$temp = "";
			$offset = 0;
			do {
				$idx1 = strpos($mapbody, "\r\n", $offset);
				$chunkLength = hexdec(substr($mapbody, $offset, $idx1 - $offset));

				if ($chunkLength == 0) {
					break;
				} else {
					$temp .= substr($mapbody, $idx1+2, $chunkLength);
					$offset = $idx1 + $chunkLength + 4;
				}
			} while(true);
			$mapbody = $temp;
		}
		fclose ($fp);
	  }
	// 여기까지 주소 검색 xml 파싱

	$map_x_point_1=explode("<x>", ($mapbody));
	$map_x_point_2=explode("</x>", $map_x_point_1[1]);
	$ygeopoint_x=$map_x_point_2[0];
	$map_y_point_1=explode("<y>", ($mapbody));
	$map_y_point_2=explode("</y>", $map_y_point_1[1]);
	$ygeopoint_y=$map_y_point_2[0];
}//end function

$naver_mapkey	= "aea10b44e7d0eba886d98ae1620e8cad";//http://dev.naver.com/openapi/register 지도키 발급코드
$navermapxml_url='key='.$naver_mapkey.'&query='.getEUC_KR(str_replace(" ","",$addr));
getnavermapXml2($navermapxml_url,$ygeopoint_x,$ygeopoint_y);

?>

<!-- 네이버 지도 키 값 -->
<script type="text/javascript" src="http://map.naver.com/js/naverMap.naver?key=<?php echo $naver_mapkey?>"></script>
<!-- 네이버 지도 키 값 끝 -->
<style>
#mapcontainer{
	width: <?php echo $map_width?>px;
	height: <?php echo $map_height?>px;
	margin:0;
}
</style>
<div id="mapbody"  ></div>
<div id="display"></div>
<script type="text/javascript">
 var x_point = '<?php echo ($ygeopoint_x)?$ygeopoint_x:0; ?>';
 var y_point = '<?php echo ($ygeopoint_y)?$ygeopoint_y:0; ?>';
/*
 * 지도API 2.0은 기존의 카텍 좌표 외에도 위경도 좌표를 지원합니다.
 * 위경도 좌표를 사용하기 위해서는 기존의 NPoint 클래스 대신 NLatLng 클래스를 사용해야 합니다.
 *
 * http://maps.naver.com/api/geocode.php 에서 "경기도성남시정자1동25-1"을 검색한 결과인
 * x : 321033, y : 529749
 * 를 예로 들어 설명해 보겠습니다.
 *
 * 편의를 위해 전역변수로 mapObj, tm128, latlng를 선언해 두었습니다.
 */
var mapObj = new NMap(document.getElementById('mapbody'),<?php echo $map_width?>,<?php echo $map_height?>);
var tm128 = new NPoint(x_point,y_point);
var latlng;



	/* 지도 모드 변경 버튼 생성 */
	var mapBtns = new NMapBtns();
	mapBtns.setAlign("right");
	mapBtns.setValign("top");
	mapObj.addControl(mapBtns);

/*
 * 경기도성남시정자1동25-1의 위치로 이동합니다. 레벨은 1로 지정하였습니다.
 * 인덱스맵과 확대/축소 컨트롤러를 등록하고 마우스 줌인/아웃을 활성화 하였습니다.
 */
mapObj.setCenterAndZoom(tm128, <?php echo $yzoom?>);
//mapObj.addControl(new NIndexMap());//한국지도출력
mapObj.addControl(new NZoomControl());
mapObj.enableWheelZoom();
latlng = mapObj.fromTM128ToLatLng(tm128);
/*
 * NMark도 마찬가지로 tm128 대신 위경도를 사용하여 아이콘을 표시하였습니다.
 */
var mark = new NMark(latlng, new NIcon('<?=$g['img_module_skin']?>/ic_spot.png',new NSize(52,41),new NSize(14,40)));
mapObj.addOverlay(mark);

</script>

	<!-- //naver 지도API -->
</div>


<div style="margin-top:20px; margin-bottom:10px;"><img src="<?=$g['img_module_skin']?>/icon002.gif" /> <strong>상세내용</strong></div>
<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:15px 15px 15px 15px;line-height:17px;">
<?php echo getContents($R['content'],$R['html'],$keyword)?>
</div>

			<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
			<div class="scorebox">
			<?php if($d['theme']['show_score1']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_1.gif" alt="공감" /></a> 
			<?php endif?>
			<?php if($d['theme']['show_score2']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_2.gif" alt="비공감" /></a> 
			<?php endif?>
			</div>
			<?php endif?>


			<?php if($d['upload']['data']&&$d['theme']['show_upfile']):?>
			<div class="attach">
			<ul>
			<?php foreach($d['upload']['data'] as $_u):?>
			<?php if($_u['hidden'])continue?>
			<li>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>"><?php echo $_u['name']?></a>
				<span class="size">(<?php echo getSizeFormat($_u['size'],1)?>)</span>
				<span class="down">(<?php echo number_format($_u['down'])?>)</span>
			</li>
			<?php endforeach?>
			</ul>
			</div>
			<?php endif?>

			<?php if($d['theme']['snsping']):?>
			<div class="snsbox">
			<img src="<?php echo $g['img_core']?>/_public/sns_t1.gif" alt="twitter" title="게시글을 twitter로 보내기" onclick="snsWin('t');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_f1.gif" alt="facebook" title="게시글을 facebook으로 보내기" onclick="snsWin('f');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_m1.gif" alt="me2day" title="게시글을 me2day로 보내기" onclick="snsWin('m');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_y1.gif" alt="요즘" title="게시글을 요즘으로 보내기" onclick="snsWin('y');" />
			</div>
			<?php endif?>
		</div>
	</div>

	<?php if($iframe == Y):?>
<?php else:?>
<div class="bottom">
		<span class="btn00"><a href="<?php echo $g['bbs_modify'].$R['uid']?>">수정</a></span>
		<?php if($d['theme']['use_reply']):?><span class="btn00"><a href="<?php echo $g['bbs_reply'].$R['uid']?>">답변</a></span><?php endif?>
		<span class="btn00"><a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a></span>
		<?php if($my['admin']):?>
		<span class="btn00"><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_move&postuid=<?php echo $R['uid']?>');">이동</a></span>
		<span class="btn00"><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_copy&postuid=<?php echo $R['uid']?>');">복사</a></span>
		<?php endif?>
		<span class="btn00"><a href="<?php echo $g['bbs_list']?>">목록으로</a></span>
	</div>
<?php endif?>

	<?php if(!$d['bbs']['c_hidden']):?>
	<div class="comment">
		<img src="<?php echo $g['img_module_skin']?>/ico_comment.gif" alt="" class="icon1" />
		<a href="#." onclick="commentShow('comment');">댓글 <span id="comment_num<?php echo $R['uid']?>"><?php echo $R['comment']?></span>개</a>
		<?php if(getNew($R['d_comment'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
		<?php if($d['theme']['use_trackback']):?>
		| <a href="#." onclick="commentShow('trackback');">엮인글 <span id="trackback_num<?php echo $R['uid']?>"><?php echo $R['trackback']?></span>개</a>
		<?php if(getNew($R['d_trackback'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
		<?php endif?>
	</div>
	<a name="CMT"></a>
	<iframe name="commentFrame" id="commentFrame" src="<?php if(!$d['bbs']['c_hidden']&&($CMT || $d['bbs']['c_open'])):?><?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=comment&amp;skin=<?php echo $d['bbs']['c_skin']?>&amp;hidepost=<?php echo ($R['display']?0:1)?>&amp;iframe=Y&amp;cync=[<?php echo $m?>][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>][m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]&amp;CMT=<?php echo $CMT?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
	<?php endif?>

</div> 


<script type="text/javascript">
//<![CDATA[
<?php if($d['theme']['snsping']):?>
function snsWin(sns)
{
	var snsset = new Array();
	var enc_tit = "<?php echo urlencode($_HS['title'])?>";
	var enc_sbj = "<?php echo urlencode($R['subject'])?>";
	var enc_url = "<?php echo urlencode($g['url_root'].($_HS['rewrite']?($_HS['usescode']?'/'.$r:'').'/b/'.$R['bbsid'].'/'.$R['uid']:'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&bid='.$R['bbsid'].'&uid='.$R['uid']))?>";
	var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";

	snsset['t'] = 'http://twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
	snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
	snsset['m'] = 'http://me2day.net/posts/new?new_post[body]=' + enc_sbj + '+++["'+enc_tit+'":' + enc_url + '+]&new_post[tags]='+enc_tag;
	snsset['y'] = 'http://yozm.daum.net/api/popup/prePost?sourceid=' + enc_url + '&prefix=' + enc_sbj;
	window.open(snsset[sns]);
}
<?php endif?>
function printWindow(url) 
{
	window.open(url,'printw','left=0,top=0,width=700px,height=600px,statusbar=no,scrollbars=yes,toolbar=yes');
}
function commentShow(type)
{
	var url;
	if (type == 'comment')
	{
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $d['bbs']['c_skin']?>&hidepost=<?php echo ($R['display']?0:1)?>&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[uid,comment,oneline,d_comment]';
		url+= '[<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&CMT=<?php echo $CMT?>';
	}
	else {
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=trackback&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&TBK=<?php echo $TBK?>';
	}

	frames.commentFrame.location.href = url;
}
function setImgSizeSetting()
{
	<?php if($d['theme']['use_autoresize']):?>
	var ofs = getOfs(getId('vContent')); 
	getDivWidth(ofs.width,'vContent');
	<?php endif?>
	getId('vContent').style.fontFamily = getCookie('myFontFamily');
	getId('vContent').style.fontSize = getCookie('myFontSize');

	<?php if($TRACKBACK):?>
	commentShow('trackback');
	<?php endif?>

	<?php if($print=='Y'):?>
	document.body.style.padding = '15px';
	self.print();
	<?php endif?>
}
window.onload = setImgSizeSetting;
//]]>
</script>


<?php if($iframe == Y):?>
<?php else:?>
<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>

<?php endif?>
<?php endif?>

