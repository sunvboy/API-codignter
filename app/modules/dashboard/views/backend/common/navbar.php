<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
		<?php ?>
	</div>
	<ul class="nav navbar-top-links navbar-right">
		<li>
			<span class="m-r-sm text-muted welcome-message">Welcome to OVN CMS V.1.0+</span>
		</li>
		<li>
			<a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
				<img src="<?php if ($this->fclang == 'vietnamese') { ?>template/backend/img/vietnam.gif<?php } else { ?>template/backend/img/english.png<?php } ?>" >
				<span class=""><?php if ($this->fclang == 'vietnamese') { ?>Vietnamese<?php } else { ?>English<?php } ?></span>
				<span class="fa fa-angle-down"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="javascript:void(0);" data-lang="vietnamese" class="language-header"> <img class="image_flag" src="template/backend/img/vietnam.gif" alt="Vietnamese" title="Vietnamese">  Vietnamese </a></li>
				<li><a href="javascript:void(0);" data-lang="english" class="language-header"><img class="image_flag" src="template/backend/img/english.png" alt="English" title="English"> English </a></li>
			</ul>
			<script>
				$(document).ready(function() {
					$('.language-header').click(function(event) {
						var lang = $(this).attr('data-lang');
						$.post('general/ajax/systems/language.html', {lang: lang}, function(data){
							window.location.reload();
						});
					});
				});
			</script>
		</li>

		<li>
			<a href="<?php echo site_url('user/backend/auth/logout'); ?>">
				<i class="fa fa-sign-out"></i> Đăng xuất
			</a>
		</li>

	</ul>
</nav>