<?php $main_nav = navigation(array('keyword' => 'main', 'output' => 'array')); ?>
<?php if(isset($main_nav) && is_array($main_nav) && count($main_nav)){ ?>
<section class="lower">
	<div class="uk-container uk-container-center">
		<div class="uk-flex uk-flex-middle uk-flex-space-between">
			<nav class="main-nav">
				<ul class="uk-navbar-nav uk-clearfix main-menu">
					<?php foreach($main_nav as $key => $val){ ?>
					<li><a href="<?php echo $val['link']; ?>" title="<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a>
						<?php if(isset($val['children']) && is_array($val['children']) && count($val['children'])){ ?>
						<div class="dropdown-menu">
							<ul class="uk-list children">
								<?php foreach($val['children'] as $keyItem => $valItem){ ?>
								<li><a href="<?php echo $valItem['link'] ?>" title="<?php echo $valItem['title'] ?>"><?php echo $valItem['title'] ?></a></li>
								<?php } ?>
							</ul>
						</div>
						<?php } ?>
					</li>
					<?php } ?>
				</ul>
			</nav>
			<div class="hd-download"><a href="<?php echo $this->fcSystem['homepage_catalog']; ?>" title="Tải file Catalog" class="btn-download" download>Catalog</a></div>
		</div>
	</div>
</section>
<?php } ?>