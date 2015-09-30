<!DOCTYPE html>
<html>

<head>
	<title>图片上传</title>
	<script type="text/javascript" src="/assets/js/jquery-1.7.2.min.js"></script>
</head>
<body>
<div>
	<form enctype="multipart/form-data" id="image_form" action="/file/file_save" method="post" target="upload_target">
	     <input type="file" name="image" id="image"/>
	</form>
	<iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0;overflow:hidden">
		
	</iframe> 
	<div class="images_img">
		
	</div>
</div>
</body>
<script type="text/javascript">
	//显示图片
	function image_save(path,img_name){
		$this = $('.images_img');
		var img_size = $this.find('img').size();
		if(img_size){
			$this.find('img').attr('src',path);
			$this.find('input').attr('value',img_name);
		}else{
			$this.append($('<img/>').attr('src',path).css({"width":"100px","height":"100px"}));
			$this.append($('<input/>').attr({'name':'image_name','value':img_name,'type':'hidden','class':'u_image'}));
		}
		$("#image").val('');
	}	
	//提交图片
	$("#image").change(function(){
		$("#image_form").submit();
	})
</script>
</html>