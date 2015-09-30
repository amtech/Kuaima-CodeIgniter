<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
		<title>后台管理系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen">
		<link id="color" rel="stylesheet" type="text/css" href="/assets/css/blue.css">
		<!-- scripts (jquery) -->
		<script src="/assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="/assets/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<script src="/assets/js/smooth.js" type="text/javascript"></script>
		
	</head>
	<body>
		<div id="login">
			<!-- login -->
			<div class="title">
				<h5>后台管理系统登录</h5>
				<div class="corner tl"></div>
				<div class="corner tr"></div>
			</div>
			<div class="messages">
				<div id="message-error" class="message message-error" style="display: none;">
					<div class="image">
						<img src="/assets/images/error.png" alt="Error" height="32">
					</div>
					<div class="text">
						<h6>错误信息</h6>
						<span>请填写完整的信息</span>
					</div>
					<div class="dismiss">
						<a href="#message-error"></a>
					</div>
				</div>
				
				<div id="login-error" class="message message-error" style="display: none;">
					<div class="image">
						<img src="/assets/images/error.png" alt="Error" height="32">
					</div>
					<div class="text">
						<h6>错误信息</h6>
						<span>账号或者密码错误</span>
					</div>
					<div class="dismiss">
						<a href="#login-error"></a>
					</div>
				</div>
				
			</div>
			<div class="messages" style="height:20px;">
				
			</div>
			<div class="inner">
				<form action="" method="post">
				<div class="form">
					<!-- fields -->
					<div class="fields">
						<div class="field">
							<div class="label" style="height:40px;"> 
								<label for="username">账 号:</label>
							</div>
							<div class="input">
								<input id="username" name="username" size="40" class="focus" type="text">
							</div>
						</div>
						<div class="field">
							<div class="label"  style="height:40px;">
								<label for="password">密 码:</label>
							</div>
							<div class="input">
								<input id="password" name="password" size="40" class="focus" type="password">
							</div>
						</div>
						<div class="buttons">
							<input class="ui-button ui-widget ui-state-default ui-corner-all submit_form" value=" 登  陆 " type="button">
						</div>
					</div>
					<!-- end fields -->
				</div>
				</form>
			</div>
			<div class="messages" style="height:20px;">
				
			</div>
			<!-- end login -->
		</div>
	</body>
	<script type="text/javascript">
		$(function(){
			$(".submit_form").click(function(){
				var username = $.trim($("#username").val());
				var password = $.trim($("#password").val());
				if(username.length<1){
					$("#message-error").show();
					$("#username").focus();
					return false;
				}
				if(password.length<1){
					$("#message-error").show();
					$("#password").focus();
					return false;
				}
				
				$.post("/admin/admin/check_admin",{'username':username,'password':password},function(msg){
					if(msg == "succ"){
						location.href = "/admin/admin/admin_list";
					}else{
						$("#login-error").show();
					}
				});
			})
		})
	</script>
</html>