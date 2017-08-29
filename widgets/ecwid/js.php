<script type="text/javascript">
$(document).ready(function() {
    $('.ecwid-connect').click(function() {
        window.ecwidConnectReload = function() {
            this.app.content.reload();
		}
		window.connectWnd = window.open(
			'<?php echo u('panel/ecwid/connect'); ?>',
			'ecwid-connect',
			'height=600,width=400,modal=true'
		);
        
        
        ecwidConnectReload = function() {
            if (window.connectWnd.closed) {
                app.content.reload();
            } else {
				app.delay.start('ecwidConnectTicker', ecwidConnectReload, 1000);
            }
		}
        
        app.delay.start('ecwidConnectTicker', ecwidConnectReload, 1000);
	});
})	
</script>