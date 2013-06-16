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
   
<LINK href="<?=$g['img_module_skin']?>/basic.css" type=text/css rel=stylesheet>
<LINK href="<?=$g['img_module_skin']?>/style.css" type=text/css rel=stylesheet>

<SCRIPT src="<?=$g['img_module_skin']?>/jquery-1.4.2.min.js" type=text/javascript></SCRIPT>
<SCRIPT src="<?=$g['img_module_skin']?>/libs.js" type=text/javascript charset=utf-8></SCRIPT>
<SCRIPT src="<?=$g['img_module_skin']?>/scripts.js" type=text/javascript charset=utf-8></SCRIPT>


<div id="bbslist">

	<div class="info">

		<div class="article">
			<?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
			<?php if($d['bbs']['rss']):?><a href="<?php echo $g['r']?>/?m=<?php echo $m?>&amp;bid=<?php echo $B['id']?>&amp;mod=rss" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_rss.gif" alt="rss" /></a><?php endif?>
		</div>
		
		<div class="category">
			<?php if($my['admin']):?>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;&amp;uid=<?php echo $B['uid']?>"><img src="<?php echo $g['img_core']?>/_public/btn_admin.gif" alt="" title="게시판관리" /></a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;front=skin&amp;theme=<?php echo $d['bbs']['skin']?>"><img src="<?php echo $g['img_core']?>/_public/btn_explorer.gif" alt="" title="테마관리" /></a>
			<?php endif?>

			<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
			<?php endif?>
		</div>
		<div class="clear"></div>
	</div>

	<?php if(count($NCD)):?>
	<table summary="<?php echo $B['name']?$B['name']:'전체'?> 게시물리스트 입니다.">
	<caption><?php echo $B['name']?$B['name']:'전체게시물'?></caption> 
	<colgroup> 
	<col width="50"> 
	<col> 
	<col width="80"> 
	<col width="70"> 
	<col width="90"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1">번호</th>
	<th scope="col">제목</th>
	<th scope="col">글쓴이</th>
	<th scope="col">조회</th>
	<th scope="col" class="side2">날짜</th>
	</tr>
	</thead>
	<tbody>

	<?php foreach($NCD as $R):?> 
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<tr class="noticetr">
	<td>
		<?php if($R['uid'] != $uid):?>
		<img src="<?php echo $g['img_module_skin']?>/ico_notice.gif" alt="공지" class="notice" />
		<?php else:?>
		<span class="now">&gt;&gt;</span>
		<?php endif?>
	</td>
	<td class="sbj">
		<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
		<a href="<?php echo $g['bbs_view'].$R['uid']?>" class="b"><?php echo $R['subject']?></a>
		<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
		<?php if($R['comment']):?><span class="comment">[<?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?>]</span><?php endif?>
		<?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span><?php endif?>
		<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><span class="hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php echo $R[$_HS['nametype']]?></span></td>
	<td class="hit b"><?php echo $R['hit']?></td>
	<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
	</tr> 
	<?php endforeach?> 
	</tbody>
	</table>
	<?php else:?>
	<div class="ttline"></div>
	<?php endif?>

	<?php if($NUM):?> 

		<?php foreach($RCD as $R):?>
		<?php $R['mobile']=isMobileConnect($R['agent'])?>
		<?php $R['mobile']=isMobileConnect($R['agent'])?>
		<?php $_thumbimg=getUploadImage($R['upload'],$R['d_regis'],$R['content'],'gif|jpg|jpeg')?>
	    <?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_module_skin'].'/noimg.gif'?>
	    <?php $_thumbimg2=$_thumbimg2?$_thumbimg2:$g['img_core'].'/blank.gif'?>
		
		<?php $adddata_exp=explode("|" , $R['adddata'])?>
	    <?php $add_txt1_exp=explode("|" , $R['add_txt1'])?>
	    <?php $add_txt2_exp=explode("|" , $R['add_txt2'])?>
	    <?php $add_txt3_exp=explode("|" , $R['add_txt3'])?>
	    <?php $add_txt4_exp=explode("|" , $R['add_txt4'])?>
		<?php $add_txt5_exp=explode("|" , $R['add_txt5'])?>
		<?$UPIMG=getUpfiles($R['upload'])?>

<!-- 추가시작 -->
<DIV class=portfolio>
<DIV class=portfolio_content>
<DIV class=portfolio_description>
<H3 style="FONT-FAMILY: 맑은 고딕"><A href="<?php echo $g['bbs_view'].$R['uid']?>"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?></A> 
</H3>
<P><?=getStrCut(strip_tags($R['content']),65,'...')?> <a href="<?php echo $g['bbs_view'].$R['uid']?>">more</a></P>
</DIV>


<DIV class=portfolio_details>
<table class="bbs-view mgb20" >
  <colgroup>
  <col style="width:50px; height:24px" />
  <col />
  </colgroup>
  <tbody>
    <tr>
      <th> 위치</th>
      <td><?=$add_txt1_exp[2]?> <?=$add_txt1_exp[3]?></td>
    </tr>
    <tr>
      <th> 간략설명 </th>
      <td><?php echo $R['add_txt6']?></td>
    </tr>
    <tr>
      <th> 옵션 </th>
      <td>
	  <?php if($add_txt5_exp[0] == 1):?>
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
</table>
</DIV>
<DIV class=portfolio_images>
<DIV class=portfolio_images_no>
<P>+ hit :</P> <?php echo $R['hit']?></DIV>
<?if($UPIMG[0]):?><img  class=active src="<?=$QURL['upload'].'files/'.$UPIMG[0]['folder'].'/'.$UPIMG[0]['tmpname']?>"/><?else:?><img  class=active src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[1]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[1]['folder'].'/'.$UPIMG[1]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[2]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[2]['folder'].'/'.$UPIMG[2]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[3]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[3]['folder'].'/'.$UPIMG[3]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[4]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[4]['folder'].'/'.$UPIMG[4]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[5]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[5]['folder'].'/'.$UPIMG[5]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[6]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[6]['folder'].'/'.$UPIMG[6]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[7]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[7]['folder'].'/'.$UPIMG[7]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[8]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[8]['folder'].'/'.$UPIMG[8]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[9]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[9]['folder'].'/'.$UPIMG[9]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
<?if($UPIMG[10]):?><img style="DISPLAY: none" src="<?=$QURL['upload'].'files/'.$UPIMG[10]['folder'].'/'.$UPIMG[10]['tmpname']?>"/><?else:?><img style="DISPLAY: none" src="<?php echo $_thumbimg2?>" alt=""/><?endif?>
</DIV>

<DIV class=portfolio_thumbnails>
<?$UPIMG=getUpfiles($R['upload'])?>
<UL>
  <LI><?if($UPIMG[0]):?><img class=active src="<?=$QURL['upload'].'files/'.$UPIMG[0]['folder'].'/'.$UPIMG[0]['thumbname']?>"/><?else:?><img  class=active src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[1]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[1]['folder'].'/'.$UPIMG[1]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[2]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[2]['folder'].'/'.$UPIMG[2]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[3]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[3]['folder'].'/'.$UPIMG[3]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[4]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[4]['folder'].'/'.$UPIMG[4]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[5]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[5]['folder'].'/'.$UPIMG[5]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[6]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[6]['folder'].'/'.$UPIMG[6]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[7]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[7]['folder'].'/'.$UPIMG[7]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[8]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[8]['folder'].'/'.$UPIMG[8]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[9]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[9]['folder'].'/'.$UPIMG[9]['thumbname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[10]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[10]['folder'].'/'.$UPIMG[10]['tmpname']?>"/><?else:?><img src="<?php echo $_thumbimg2?>" alt=""/><?endif?></LI></UL></DIV>
<DIV class=portfolio_thumbnails_vertical>
<UL>
  <LI><?if($UPIMG[0]):?><img class=active src="<?=$QURL['upload'].'files/'.$UPIMG[0]['folder'].'/'.$UPIMG[0]['thumbname']?>" width="70" height="50"/><?else:?><img  class=active src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[1]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[1]['folder'].'/'.$UPIMG[1]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[2]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[2]['folder'].'/'.$UPIMG[2]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[3]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[3]['folder'].'/'.$UPIMG[3]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[4]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[4]['folder'].'/'.$UPIMG[4]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[5]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[5]['folder'].'/'.$UPIMG[5]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[6]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[6]['folder'].'/'.$UPIMG[6]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[7]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[7]['folder'].'/'.$UPIMG[7]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[8]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[8]['folder'].'/'.$UPIMG[8]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[9]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[9]['folder'].'/'.$UPIMG[9]['thumbname']?>" width="70" height="50"/><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI>
  <LI><?if($UPIMG[10]):?><img src="<?=$QURL['upload'].'files/'.$UPIMG[10]['folder'].'/'.$UPIMG[10]['thumbname']?>" width="70" height="50" /><?else:?><img src="<?php echo $_thumbimg2?>" width="70" height="50" alt=""/><?endif?></LI></UL></DIV>
<P class=portfolio_back>돌아가기</P><SPAN class=portfolio_info 
style="FONT-FAMILY: 맑은 고딕">이미지를 클릭하시면 갤러리모드를 종료합니다.</SPAN> 
<DIV class=portfolio_caption><SPAN></SPAN></DIV>

</DIV>
</DIV>


<!-- 추가끝 -->

		<?php endforeach?> 

	<?php endif?>



	<?php if(!$NUM):?>
	<div class="none">
		등록된 포스트가 없습니다.
	</div>
	<?php endif?>


	<div class="bottom">
		<div class="btnbox1">
		<?php if($B['uid']):?><span class="btn00"><a href="<?php echo $g['bbs_write']?>">글쓰기</a></span><?php endif?>
		</div>
		<div class="btnbox2">
		<span class="btn00"><a href="<?php echo $g['bbs_reset']?>">처음목록</a></span>
		<span class="btn00"><a href="<?php echo $g['bbs_list']?>">새로고침</a></span>
		</div>
		<div class="clear"></div>
		<div class="pagebox01">
		<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>

	<div class="searchform">
		<form name="bbssearchf" action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="bid" value="<?php echo $bid?>" />
		<input type="hidden" name="cat" value="<?php echo $cat?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />

		<?php if($d['theme']['search']):?>
		<select name="where">
		<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
		<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
		<option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
		<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
		<option value="term"<?php if($where=='term'):?> selected="selected"<?php endif?>>등록일</option>
		</select>
		
		<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		<?php endif?>
		</form>
	</div>

</div>

