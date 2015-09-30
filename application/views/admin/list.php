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
						<h5>管理员列表</h5>
						<div class="search">
							<form action="#" method="post">
								<div class="input">
									<input type="text" id="search" name="search">
								</div>
								<div class="button">
									<input type="submit" name="submit" value="Search" class="ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false">
								</div>
							</form>
						</div>
					</div>
					<!-- end box / title -->
					<div class="table">
						<form action="" method="post">
							<table>
								<thead>
									<tr>
										<th class="left" width="80%">用户名</th>
										<th class="last" width="20%">操作</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($admin_list)){?>
									<?php foreach($admin_list as $key=>$val){?>
									<tr>
										<td class="title"><?php echo $val['user_name'];?></td>
										<td class="last">
											<span>请自行进行操作</span>
										</td>
									</tr>
									<?php }?>
									<?php }?>
								</tbody>
							</table>
							<!-- pagination -->
							<div class="pagination pagination-left">
								<ul class="pager">
									<?php echo $this->pagination->create_links(); ?>
							</div>
							<!-- end pagination -->
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- end content -->
		<!-- footer -->
		<div id="footer">
			<p>Copyright © 2000-<?php echo date('Y');?> Your Company. All Rights Reserved.</p>
		</div>
		<!-- end footert -->
	</body>
</html>