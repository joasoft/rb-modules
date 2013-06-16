<script language="JavaScript"> 
<!-- 
function char_ms(write){ 
var explo; 
var explo = write.value.length; 
var str = ""; 
for (var k = (explo); k >= 0 ; k--) { 
if(write.value.substring(k-1,k) != ","){ 
str = write.value.substring(k-1,k) + str; 
} 
} 
explo = str.length; 
var msg = ""; 
var no =1; 
for (var k = (explo); k >= 0 ; k--) { 
if(no == 3 && k != 0){ 
msg = str.substring(k-1,k) + "," + msg; 
no = 0; 
} 
else { 
msg = str.substring(k-1,k) + msg ; 
} 
no++; 
} 
write.value = msg; 
write.focus(); 
return (false); 
} 
//--> 
</script> 

<div id="bbswrite">

	<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="write" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>" />
	<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
	<input type="hidden" name="reply" value="<?php echo $reply?>" />
	<input type="hidden" name="nlist" value="<?php echo $g['bbs_list']?>" />
	<input type="hidden" name="pcode" value="<?php echo $date['totime']?>" />
	<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>" />
	<input type="hidden" name='adddata' value="">
	<input type=hidden name='add_txt1' value="">
    <input type=hidden name='add_txt2' value="">
	<input type=hidden name='add_txt3' value="">
    <input type=hidden name='add_txt4' value="">
	<input type=hidden name='add_txt5' value="">

<?php $adddata_exp=explode("|" , $R['adddata'])?>
<?php $add_txt1_exp=explode("|" , $R['add_txt1'])?>
<?php $add_txt2_exp=explode("|" , $R['add_txt2'])?>
<?php $add_txt3_exp=explode("|" , $R['add_txt3'])?>
<?php $add_txt4_exp=explode("|" , $R['add_txt4'])?>
<?php $add_txt5_exp=explode("|" , $R['add_txt5'])?>


<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:8px 8px 8px 8px;">
  <table class="bbs-view mgb20">
    <colgroup>
    <col style="width:100px;" />
    <col />
    </colgroup>
    <tbody>
      <?php if(!$my['id']):?>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 작성자명</th>
        <td class="td2"><input size="20" type="text" name="name" value="<?php echo $R['name']?>" class="input subject" /></td>
      </tr>
      <?php if(!$R['uid']||$reply=='Y'):?>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 비밀번호</th>
        <td><input size="20" type="password" name="pw" value="<?php echo $R['pw']?>" class="input subject" />
            <?php if($R['hidden']&&$reply=='Y'):?>
            <div class="guide"> <img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다. </div>
            <?php endif?></td>
      </tr>
      <?php endif?>
      <?php endif?>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' />  업체명</th>
        <td class="td2"><input type="text" name="subject" value="<?php echo htmlspecialchars($R['subject'])?>" class="input subject" />
            <span class="check">
            <?php if($my['admin']):?>
            <input type="checkbox" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?> />
        공지글
        <?php endif?>
        <?php if($d['theme']['use_hidden']==1):?>
        <input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />
        비밀글
        <?php elseif($d['theme']['use_hidden']==2):?>
        <input type="hidden" name="hidden" value="1" />
        <?php endif?>
          </span> </td>
      </tr>
<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 지역구분</th>
        <td><select name="category">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?>선택</option>
			<option value="">-----------------------------------------------------------------------------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
			<?php if($my['admin']):?>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;uid=<?php echo $B['uid']?>"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" title="추가" /></a>
			<?php endif?>		</td>
      </tr>
<?php endif?>
    </tbody>
  </table>
</div>


<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:8px 8px 8px 8px;margin-top:20px;">

<table class="bbs-view mgb20">
    <colgroup>
    <col style="width:90px;" />
    <col style="width:260px;" />
	<col style="width:90px;" />
    <col />
    </colgroup>
    <tbody>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 주소</th>
        <td colspan="3"><input type=text name=zip1_01 id=zip1_01 size=4 maxlength=3 value="<?=$add_txt1_exp[0]?>" />
          -
          <input type=text name=zip1_02 id="zip2" size=4 maxlength=3 value="<?php echo $add_txt1_exp[1]?>" />
        <img src='<?=$g['img_module_skin']?>/btn_zip.gif' align=absmiddle style='cursor:pointer;' onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=zipsearch&zip1=zip1_01&zip2=zip1_02&addr1=zip1_03&focusfield=zip1_04');" /><br />
        <input type=text name=zip1_03 id="addr1" size=50 readonly value="<?php echo $add_txt1_exp[2]?>" class="input subject" />
        <br />
        <input type=text name=zip1_04 id="addr2" size=50 value="<?php echo $add_txt1_exp[3]?>" class="input subject" /></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 대표번호</th>
        <td colspan="3"><input type="text" name="info_01" size="4" value="<?php echo $add_txt2_exp[0]?>" class="input subject">
      -
            <input type="text" name="info_02" size="4" value="<?php echo $add_txt2_exp[1]?>" class="input subject">
      -
            <input type="text" name="info_03" size="4" value="<?php echo $add_txt2_exp[2]?>" class="input subject"></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 영업시간</th>
        <td colspan="3"><select name="add_int1">
  <option value="">- 영업시작시간 -</option>
  <option value="1" <?if ($R['add_int1'] == '1') echo "selected"?>>00 : 00</option>
  <option value="2" <?if ($R['add_int1'] == '2') echo "selected"?>>01 : 00</option>
  <option value="3" <?if ($R['add_int1'] == '3') echo "selected"?>>02 : 00</option>
  <option value="4" <?if ($R['add_int1'] == '4') echo "selected"?>>03 : 00</option>
  <option value="5" <?if ($R['add_int1'] == '5') echo "selected"?>>04 : 00</option>
  <option value="6" <?if ($R['add_int1'] == '6') echo "selected"?>>05 : 00</option>
  <option value="7" <?if ($R['add_int1'] == '7') echo "selected"?>>06 : 00</option>
  <option value="8" <?if ($R['add_int1'] == '8') echo "selected"?>>07 : 00</option>
  <option value="9" <?if ($R['add_int1'] == '9') echo "selected"?>>08 : 00</option>
  <option value="10" <?if ($R['add_int1'] == '10') echo "selected"?>>09 : 00</option>
  <option value="11" <?if ($R['add_int1'] == '11') echo "selected"?>>10 : 00</option>
  <option value="12" <?if ($R['add_int1'] == '12') echo "selected"?>>11 : 00</option>
  <option value="13" <?if ($R['add_int1'] == '13') echo "selected"?>>12 : 00</option>
  <option value="14" <?if ($R['add_int1'] == '14') echo "selected"?>>13 : 00</option>
  <option value="15" <?if ($R['add_int1'] == '15') echo "selected"?>>14 : 00</option>
  <option value="16" <?if ($R['add_int1'] == '16') echo "selected"?>>15 : 00</option>
  <option value="17" <?if ($R['add_int1'] == '17') echo "selected"?>>16 : 00</option>
  <option value="18" <?if ($R['add_int1'] == '18') echo "selected"?>>17 : 00</option>
  <option value="19" <?if ($R['add_int1'] == '19') echo "selected"?>>18 : 00</option>
  <option value="20" <?if ($R['add_int1'] == '20') echo "selected"?>>19 : 00</option>
  <option value="21" <?if ($R['add_int1'] == '21') echo "selected"?>>20 : 00</option>
  <option value="22" <?if ($R['add_int1'] == '22') echo "selected"?>>21 : 00</option>
  <option value="23" <?if ($R['add_int1'] == '23') echo "selected"?>>22 : 00</option>
  <option value="24" <?if ($R['add_int1'] == '24') echo "selected"?>>23 : 00</option>
</select>
영업시작 ~ 
<select name="add_int2">
  <option value="">- 영업마감시간 -</option>
  <option value="1" <?if ($R['add_int2'] == '1') echo "selected"?>>00 : 00</option>
  <option value="2" <?if ($R['add_int2'] == '2') echo "selected"?>>01 : 00</option>
  <option value="3" <?if ($R['add_int2'] == '3') echo "selected"?>>02 : 00</option>
  <option value="4" <?if ($R['add_int2'] == '4') echo "selected"?>>03 : 00</option>
  <option value="5" <?if ($R['add_int2'] == '5') echo "selected"?>>04 : 00</option>
  <option value="6" <?if ($R['add_int2'] == '6') echo "selected"?>>05 : 00</option>
  <option value="7" <?if ($R['add_int2'] == '7') echo "selected"?>>06 : 00</option>
  <option value="8" <?if ($R['add_int2'] == '8') echo "selected"?>>07 : 00</option>
  <option value="9" <?if ($R['add_int2'] == '9') echo "selected"?>>08 : 00</option>
  <option value="10" <?if ($R['add_int2'] == '10') echo "selected"?>>09 : 00</option>
  <option value="11" <?if ($R['add_int2'] == '11') echo "selected"?>>10 : 00</option>
  <option value="12" <?if ($R['add_int2'] == '12') echo "selected"?>>11 : 00</option>
  <option value="13" <?if ($R['add_int2'] == '13') echo "selected"?>>12 : 00</option>
  <option value="14" <?if ($R['add_int2'] == '14') echo "selected"?>>13 : 00</option>
  <option value="15" <?if ($R['add_int2'] == '15') echo "selected"?>>14 : 00</option>
  <option value="16" <?if ($R['add_int2'] == '16') echo "selected"?>>15 : 00</option>
  <option value="17" <?if ($R['add_int2'] == '17') echo "selected"?>>16 : 00</option>
  <option value="18" <?if ($R['add_int2'] == '18') echo "selected"?>>17 : 00</option>
  <option value="19" <?if ($R['add_int2'] == '19') echo "selected"?>>18 : 00</option>
  <option value="20" <?if ($R['add_int2'] == '20') echo "selected"?>>19 : 00</option>
  <option value="21" <?if ($R['add_int2'] == '21') echo "selected"?>>20 : 00</option>
  <option value="22" <?if ($R['add_int2'] == '22') echo "selected"?>>21 : 00</option>
  <option value="23" <?if ($R['add_int2'] == '23') echo "selected"?>>22 : 00</option>
  <option value="24" <?if ($R['add_int2'] == '24') echo "selected"?>>23 : 00</option>
</select> 
영업마감</td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 휴무일</th>
        <td colspan="3"><select name="add_int3">
  <option value="">- 정기휴일 -</option>
  <option value="1" <?if ($R['add_int3'] == '1') echo "selected"?>>월요일</option>
  <option value="2" <?if ($R['add_int3'] == '2') echo "selected"?>>화요일</option>
  <option value="3" <?if ($R['add_int3'] == '3') echo "selected"?>>수요일</option>
  <option value="4" <?if ($R['add_int3'] == '4') echo "selected"?>>목요일</option>
  <option value="5" <?if ($R['add_int3'] == '5') echo "selected"?>>금요일</option>
  <option value="6" <?if ($R['add_int3'] == '6') echo "selected"?>>토요일</option>
  <option value="7" <?if ($R['add_int3'] == '7') echo "selected"?>>일요일</option>
  <option value="8" <?if ($R['add_int3'] == '8') echo "selected"?>>연중무휴</option>
</select></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 주차대수</th>
        <td><input type=text name=c_01 style='width:40px;' value='<?=$add_txt3_exp[0]?>' />	숫자만 입력</td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 카드여부</th>
        <td><INPUT TYPE="radio" NAME="add_int4" value="1" <?if($R['add_int4'] == '1'):?> checked<?endif;?>> 사용가능
            <INPUT TYPE="radio" NAME="add_int4" value="2" <?if($R['add_int4'] == '2'):?> checked<?endif;?>> 불가능</td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 좌석수</th>
        <td><input type=text name=c_02 style='width:40px;' value='<?=$add_txt3_exp[1]?>' />	숫자만 입력</td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 흡연여부</th>
        <td><INPUT TYPE="radio" NAME="add_int5" value="1" <?if($R['add_int5'] == '1'):?> checked<?endif;?>> 흡연가능
            <INPUT TYPE="radio" NAME="add_int5" value="2" <?if($R['add_int5'] == '2'):?> checked<?endif;?>> 비흡연전용
	        <INPUT TYPE="radio" NAME="add_int5" value="3" <?if($R['add_int5'] == '3'):?> checked<?endif;?>> 흡연전용석</td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 배달여부</th>
        <td><INPUT TYPE="radio" NAME="add_int6" value="1" <?if($R['add_int6'] == '1'):?> checked<?endif;?>> 상시배달가능
            <INPUT TYPE="radio" NAME="add_int6" value="2" <?if($R['add_int6'] == '2'):?> checked<?endif;?>> 시간대가능
            <INPUT TYPE="radio" NAME="add_int6" value="3" <?if($R['add_int6'] == '3'):?> checked<?endif;?>> 불가능</td>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 예약여부</th>
        <td><INPUT TYPE="radio" NAME="add_int7" value="1" <?if($R['add_int7'] == '1'):?> checked<?endif;?>> 예약가능
            <INPUT TYPE="radio" NAME="add_int7" value="2" <?if($R['add_int7'] == '2'):?> checked<?endif;?>> 불가능</td>
      </tr>
	        <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 옵션아이콘</th>
        <td colspan="3">
		<input type="checkbox" name='OPTI_1' value="1" <?if($add_txt5_exp[0]):?> checked<?endif;?>><IMG alt="무료주차" src="<?=$g['img_module_skin']?>/icons_mini_11.gif"> 
	    <input type="checkbox" name='OPTI_2' value="2" <?if($add_txt5_exp[1]):?> checked<?endif;?>><IMG alt="24시간 오픈 아님" src="<?=$g['img_module_skin']?>/icons_mini_02.gif"> 
	    <input type="checkbox" name='OPTI_3' value="3" <?if($add_txt5_exp[2]):?> checked<?endif;?>><IMG alt="배달불가" src="<?=$g['img_module_skin']?>/icons_mini_03.gif"> 
	    <input type="checkbox" name='OPTI_4' value="4" <?if($add_txt5_exp[3]):?> checked<?endif;?>><IMG src="<?=$g['img_module_skin']?>/icons_mini_04.gif" alt="홈페이지"></a> 
	    <input type="checkbox" name='OPTI_5' value="5" <?if($add_txt5_exp[4]):?> checked<?endif;?>><IMG alt="진행중인 이벤트" src="<?=$g['img_module_skin']?>/icons_mini_06.gif"></td>
	        </tr>
    </tbody>
  </table>
</div>

<div style="background:#ffffff;border:solid 1px #dfdfdf;padding:8px 8px 8px 8px;margin-top:20px;">

<table class="bbs-view mgb20">
    <colgroup>
    <col style="width:90px;" />
    <col />
    </colgroup>
    <tbody>
	   <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 간략소개</th>
        <td><textarea name="add_txt6" cols="80" rows="5" style="width:98%;border:1px solid #c0c0c0;" ><?php echo $R['add_txt6']?>
</textarea></td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 홈페이지</th>
        <td><input type="text" name="h_01" size="50" value="<?php echo $add_txt4_exp[0]?>" />  http:// 포함</td>
      </tr>
      <tr>
        <th><img src='<?=$g['img_module_skin']?>/dot_write_01.gif' /> 동영상</th>
        <td><input type="text" name="h_02" size="50" value="<?php echo $add_txt4_exp[1]?>" />  동영상 주소 링크전용</td>
      </tr>
    </tbody>
  </table>
</div>

	<div class="editbox">
		<?php if(!$g['mobile']&&$d['theme']['edit_html']<=$my['level']):?>
		<div class="iconbox">
			<?php if($d['theme']['perm_photo'] <= $my['level']):?>
			<a href="#." onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=upload&mod=photo&gparam=upfilesValue|upfilesFrame|editFrame');" /><img src="<?php echo $g['img_core']?>/_public/ico_photo.gif" alt="" />사진</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<?php endif?>
			<?php if($d['theme']['perm_upload'] <= $my['level']):?>
			<a href="#." onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=upload&mod=file&gparam=upfilesValue|upfilesFrame');" /><img src="<?php echo $g['img_core']?>/_public/ico_xfile.gif" alt="" />파일</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<?php endif?>
			<a href="#." onclick="ToolCheck('layout');">레이아웃</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('table');">테이블</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('box');">박스</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('char');">특수문자</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('link');">링크</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />

			<a href="#." onclick="ToolCheck('icon');">아이콘</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('flash');">플래쉬</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('movie');">동영상</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="ToolCheck('html');">HTML</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a href="#." onclick="frames.editFrame.ToolboxShowHide(0);" /><img src="<?php echo $g['img_core']?>/_public/ico_edit.gif" alt="" />편집</a>
		</div>
		<?php endif?>

		<div>
		<input type="hidden" name="html" id="editFrameHtml" value="<?php echo $d['theme']['edit_html']>$my['level']?'TEXT':($R['html']?$R['html']:'HTML')?>" />
		<input type="hidden" name="content" id="editFrameContent" value="<?php echo htmlspecialchars($R['content'])?>" />
		<iframe name="editFrame" id="editFrame" src="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=editor&amp;toolbox=<?php echo $d['theme']['show_edittool2']&&$d['theme']['edit_html']<=$my['level']?'Y':'N'?>" width="100%" height="<?php echo $d['theme']['edit_height']?>" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
		</div>
		
		<?php if($d['theme']['perm_upload']||$d['theme']['perm_photo']):?>
		<div>
		<iframe name="upfilesFrame" id="upfilesFrame" src="<?php echo $g['s']?>/?r=<?php echo $r?>&m=upload&amp;mod=list&amp;gparam=upfilesValue|editFrame&amp;code=<?php echo $reply=='Y'?'':$R['upload']?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
		</div>
		<?php endif?>
	</div>

	<table>

		<?php if($d['theme']['show_trackback']):?>
		<tr>
		<td class="td1">엮을주소</td>
		<td class="td2">
			<input size="80" type="text" name="trackback" value="" class="input subject" />
			<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('bbsTrackback','block','none');" />
			<div id="bbsTrackback" class="guide hide">
			<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
			이 게시물을 보낼 트랙백주소를 입력해 주세요.
			</div>				
		</td>
		</tr>
		<?php endif?>

		<?php if((!$R['uid']||$reply=='Y')&&is_file($g['path_module'].$d['bbs']['snsconnect'])):?>
		<tr>
		<td class="td1" style="padding-top:18px;">소셜연동</td>
		<td class="td2 shift">
			<br />
			<?php include_once $g['path_module'].$d['bbs']['snsconnect']?> 에도 게시물을 등록합니다.
		</td>
		</tr>
		<?php endif?>

		<tr>
		<td class="td1"></td>
		<td class="td2">
			<div class="after">
			게시물 등록(수정/답변)후
			<input type="radio" name="backtype" id="backtype1" value="list"<?php if(!$_SESSION['bbsback'] || $_SESSION['bbsback']=='list'):?> checked="checked"<?php endif?> /><label for="backtype1">목록으로 이동</label>
			<input type="radio" name="backtype" id="backtype2" value="view"<?php if($_SESSION['bbsback']=='view'):?> checked="checked"<?php endif?> /><label for="backtype2">본문으로 이동</label>
			<input type="radio" name="backtype" id="backtype3" value="now"<?php if($_SESSION['bbsback']=='now'):?> checked="checked"<?php endif?> /><label for="backtype3">이 화면 유지</label>
			</div>
		</td>
		</tr>
	</table>

	<div class="bottombox">
		<input type="button" value="취소" class="btngray" onclick="cancelCheck();" />
		<input type="submit" value="<?if($uid):?>수정<?else:?>확인<?endif;?>" class="btnblue" />
	</div>

	</form>


</div>
