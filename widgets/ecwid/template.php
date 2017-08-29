<?php require_once __DIR__ . DS . 'js.php'; ?>

<?php if (Ecwid::get('storeID')): ?>
<div class="ecwid-first-row">
    <span class="ecwid-store-id">Connected Store ID: <?php echo Ecwid::get('storeID'); ?></span> 
    <a class="btn btn-rounded btn-ecwid-dashboard" href="<?php echo u('panel/ecwid'); ?>">Dashboard</a>
</div>
<?php endif; ?>
<div>
	<?php if (Ecwid::get('storeID')): ?>
    <a class="ecwid-connect ecwid-reconnect ecwid-connect-link" href="javascript:void(0);">Disconnect and connect another store</a>    
    <?php else: ?>
    <a class="btn btn-rounded" href="https://my.ecwid.com/?partner=kirby#register">Create Free Store</a>  
    <br/>
    <a class="ecwid-connect ecwid-connect-link" href="javascript:void(0);">Connect Existing Ecwid Store</a>
    <?php endif; ?>
</div>
    