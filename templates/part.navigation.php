<div id="app-navigation">
	<ul>
		<?php foreach ($_['navigationItems'] as $item) { ?>
			<li data-id="<?php p($item['id']) ?>" class="nav-<?php p($item['id']) ?>"><a href="<?php p(isset($item['href']) ? $item['href'] : '#') ?>"><?php p($item['name']);?></a></li>
		<?php } ?>
	</ul>
	<div id="app-settings">
		<div id="app-settings-header">
			<button class="settings-button" data-apps-slide-toggle="#app-settings-content"></button>
		</div>
		<div id="app-settings-content">
			<h2><?php p($l->t('Share Path'));?></h2>
			<div>
				<p><input id="path-content" type="text" value="<?php p($_['path']) ?>" /></p>
				<p><button id="savepath">Save</button></p>
			</div>
		</div>
	</div>
</div>