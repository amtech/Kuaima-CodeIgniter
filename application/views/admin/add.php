<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>后台管理系统</title>
		
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen">
		<link id="color" rel="stylesheet" type="text/css" href="/assets/css/blue.css">
		
		<script src="/assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="/assets/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<script src="/assets/js/jquery.ui.selectmenu.js" type="text/javascript"></script>
		<!-- scripts (custom) -->
		<script src="/assets/js/smooth.js" type="text/javascript"></script>
		<script src="/assets/js/smooth.menu.js" type="text/javascript"></script>
		<script src="/assets/js/smooth.table.js" type="text/javascript"></script>
		<script src="/assets/js/smooth.dialog.js" type="text/javascript"></script>
		<script src="/assets/js/smooth.autocomplete.js" type="text/javascript"></script>
	</head>
	
	<body>
		<!-- header -->
		<div id="header">
			<!-- user -->
			<ul id="user">
				<li class="first"><a href="/admin/admin/logout">安全退出</a></li>
			</ul>
			<!-- end user -->
			<div id="header-inner">
				<div id="home">
					<a href="/" title="Home" target="_blank"></a>
				</div>
			</div>
		</div>
		<!-- end header -->
		<!-- content -->
		<div id="content">
			<!-- end content / left -->
			<div id="left">
				<div id="menu">
					<h6 id="h-menu-admin" class="<?php if(@$menu == 'admin'){echo "selected";}?>"><a href="#admin"><span>管理员管理</span></a></h6>
					<ul id="menu-admin" class="<?php if(@$menu == 'admin'){echo "opened";}else{echo "closed";}?>">
						<li class="<?php if(@$menu_name == 'admin_list'){echo "selected";}?>"><a href="/admin/admin/admin_list">管理员列表</a></li>
						<li class="<?php if(@$menu_name == 'admin_add'){echo "selected";}?>"><a href="/admin/admin/admin_add">添加管理员</a></li>
					</ul>
				</div>
			</div>
			<!-- end content / left -->
			<!-- content / right -->
			<div id="right">
				<!-- table -->
				<div class="box">
					<!-- box / title -->
					<div class="title">
						<h5>添加管理员</h5>
					</div>
					
					<div id="box-messages" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
						<div class="messages">
							
							<div id="user-error" class="message message-error" style="display: none;">
								<div class="image">
									<img src="/assets/images/error.png" alt="Error" height="32">
								</div>
								<div class="text">
									<h6>错误信息</h6>
									<span>请输入用户名</span>
								</div>
								<div class="dismiss">
									<a href="#user-error"></a>
								</div>
							</div>
							
							<div id="password-error" class="message message-error" style="display: none;">
								<div class="image">
									<img src="/assets/images/error.png" alt="Error" height="32">
								</div>
								<div class="text">
									<h6>错误信息</h6>
									<span>请输入密码</span>
								</div>
								<div class="dismiss">
									<a href="#password-error"></a>
								</div>
							</div>
							
							<div id="re-password-error" class="message message-error" style="display: none;">
								<div class="image">
									<img src="/assets/images/error.png" alt="Error" height="32">
								</div>
								<div class="text">
									<h6>错误信息</h6>
									<span>请确认密码</span>
								</div>
								<div class="dismiss">
									<a href="#re-password-error"></a>
								</div>
							</div>
							
							<div id="same-error" class="message message-error" style="display: none;">
								<div class="image">
									<img src="/assets/images/error.png" alt="Error" height="32">
								</div>
								<div class="text">
									<h6>错误信息</h6>
									<span>两次密码不一致</span>
								</div>
								<div class="dismiss">
									<a href="#same-error"></a>
								</div>
							</div>
						</div>
					</div>
					
					<form id="form" action="/admin/admin/admin_add_save" method="post">
						<div class="form">
							<div class="fields">
								<div class="field  field-first">
									<div class="label">
										<label for="input-small">用户名:</label>
									</div>
									<div class="input">
										<input type="text" id="user_name" name="user_name" class="small">
									</div>
								</div>
								
								<div class="field">
									<div class="label">
										<label for="input-small">密码:</label>
									</div>
									<div class="input">
										<input type="password" id="password" name="password" class="small">
									</div>
								</div>
								
								<div class="field">
									<div class="label">
										<label for="input-small">确认密码:</label>
									</div>
									<div class="input">
										<input type="password" id="re_password" name="re_password" class="small">
									</div>
								</div>
								
								<div class="buttons">
									<input type="button" id="sub_btn" name="button" value="确 定" class="ui-button ui-widget ui-state-default ui-corner-all">
									<input type="reset" name="reset" value="取 消" class="ui-button ui-widget ui-state-default ui-corner-all">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end content -->
		<!-- footer -->
		<div id="footer">
			<p>Copyright © 2000-<?php echo date('Y');?> Your Company. All Rights Reserved.</p>
		</div>
		<!-- end footert -->
		<script type="text/javascript">
			$(function(){
				$("#sub_btn").click(function(){
					var user_name = $.trim($("#user_name").val());
					var password = $.trim($("#password").val());
					var re_password = $.trim($("#re_password").val());
					
					if(user_name.length < 1){
						$("#user-error").show();
						$("#user_name").focus();
						return false;
					}else{
						$("#user-error").hide();
					}
					
					if(password.length < 1){
						$("#password-error").show();
						$("#password").focus();
						return false;
					}else{
						$("#password-error").hide();
					}
					
					if(re_password.length < 1){
						$("#re-password-error").show();
						$("#re_password").focus();
						return false;
					}else{
						$("#re-password-error").hide();
					}
					
					if(password != re_password){
						$("#same-error").show();
						return false;
					}
					
					$("#form").submit();
				})
			})
		</script>
	</body>
</html>