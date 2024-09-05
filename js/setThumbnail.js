//input file  onchange="setThumbnail(event,this,'미리보기 표출할 이미지 태그 아이디')";
function setThumbnail(event,el,url_id) {
if(!/\.(jpeg|jpg|png)$/i.test(el.value)){
		alert('jpg,jpeg,png 파일만 업로드 가능합니다.');
		el.value = '';
		el.focus();
	}else{
	}
	for (var image of event.target.files) {
		var reader = new FileReader();
		reader.onload = function(event) {
			$('#'+url_id).attr('src',event.target.result);
		};
		reader.readAsDataURL(image);
	}
}
