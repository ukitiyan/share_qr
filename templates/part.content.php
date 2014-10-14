<p>Share QR Code: <?php p($_['user']) ?></p>

<?php if($_['imgSrc']): ?>
	<p><img src="<?php p($_['imgSrc']) ?>" /></p>
	<p><?php p($_['imgDate']) ?></p>
<?php endif ?>