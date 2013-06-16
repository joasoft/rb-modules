var submitFlag = false;
function ToolCheck(compo)
{
	frames.editFrame.showCompo();
	frames.editFrame.EditBox(compo);
}
function writeCheck(f)
{
	if (submitFlag == true)
	{
		alert('게시물을 등록하고 있습니다. 잠시만 기다려 주세요.');
		return false;
	}
	if (f.name && f.name.value == '')
	{
		alert('이름을 입력해 주세요. ');
		f.name.focus();
		return false;
	}
	if (f.pw && f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요. ');
		f.pw.focus();
		return false;
	}
	if (f.category && f.category.value == '')
	{
		alert('분류를 선택해 주세요. ');
		f.category.focus();
		return false;
	}
	if (f.subject.value == '')
	{
		alert('제목을 입력해 주세요.      ');
		f.subject.focus();
		return false;
	}
	if (f.notice && f.hidden)
	{
		if (f.notice.checked == true && f.hidden.checked == true)
		{
			alert('공지글은 비밀글로 등록할 수 없습니다.  ');
			f.hidden.checked = false;
			return false;
		}
	}
	frames.editFrame.getEditCode(f.content,f.html);
	if (f.content.value == '')
	{
		alert('내용을 입력해 주세요.       ');
		frames.editFrame.getEditFocus();
		return false;
	}

	if (getId('upfilesFrame'))
	{
		frames.upfilesFrame.dragFile();
	}

	if (f.trackback)
	{

	}
	
	
	var tmp_add_txt1 = ''; 
tmp_add_txt1 += f.zip1_01.value + "|"; 
tmp_add_txt1 += f.zip1_02.value + "|"; 
tmp_add_txt1 += f.zip1_03.value + "|"; 
tmp_add_txt1 += f.zip1_04.value + "|"; 
f.add_txt1.value = tmp_add_txt1; 

var tmp_add_txt2 = ''; 
tmp_add_txt2 += f.info_01.value + "|"; 
tmp_add_txt2 += f.info_02.value + "|";
tmp_add_txt2 += f.info_03.value + "|";
f.add_txt2.value = tmp_add_txt2; 

var tmp_add_txt3 = ''; 
tmp_add_txt3 += f.c_01.value + "|";
tmp_add_txt3 += f.c_02.value + "|";
f.add_txt3.value = tmp_add_txt3; 

var tmp_add_txt4 = ''; 
tmp_add_txt4 += f.h_01.value + "|"; 
tmp_add_txt4 += f.h_02.value + "|"; 
f.add_txt4.value = tmp_add_txt4; 

var tmp_add_txt5 = ''; 
if(f.OPTI_1.checked == true)tmp_add_txt5 += f.OPTI_1.value + "|"; else tmp_add_txt5 += "|"; 
if(f.OPTI_2.checked == true)tmp_add_txt5 += f.OPTI_2.value + "|"; else tmp_add_txt5 += "|"; 
if(f.OPTI_3.checked == true)tmp_add_txt5 += f.OPTI_3.value + "|"; else tmp_add_txt5 += "|"; 
if(f.OPTI_4.checked == true)tmp_add_txt5 += f.OPTI_4.value + "|"; else tmp_add_txt5 += "|"; 
if(f.OPTI_5.checked == true)tmp_add_txt5 += f.OPTI_5.value + "|"; else tmp_add_txt5 += "|"; 
f.add_txt5.value = tmp_add_txt5; 


	submitFlag = true;
}
function cancelCheck()
{
	if (confirm('정말 취소하시겠습니까?    '))
	{
		history.back();
	}
}