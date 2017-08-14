<?php require_once __DIR__ . DS . 'js.php'; ?>

<?php if (Ecwid::get('storeID')): ?>
<div class="ecwid-first-row">
    <span class="ecwid-store-id">Connected Store ID: <?php echo Ecwid::get('storeID'); ?></span> 
    <a class="btn btn-rounded btn-ecwid-dashboard" href="<?php echo u('panel/ecwid'); ?>">Dashboard</a>
</div>
<?php endif; ?>
<div>
	<?php if (Ecwid::get('storeID')): ?>
    <a class="ecwid-connect" href="javascript:void(0);">Disconnect and connect another store</a>    
    <?php else: ?>
    <a class="btn btn-rounded" href="<?php echo u('panel/ecwid/connect'); ?>">Connect</a>
    <?php endif; ?>
</div>
    