<script type='text/javascript'>//<![CDATA[
    jQuery(document).ready(function() {
        document.body.className += ' ecwid-no-padding';
        $ = jQuery;
        // Create IE + others compatible event handler
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        // Listen to message from child window
        eventer(messageEvent,function(e) {
            $('#ecwid-frame').css('height', e.data.height + 'px');
        },false);

        $('#ecwid-frame').attr('src', '<?php echo $iframeSrc ?>');
        ecwidSetPopupCentering('#ecwid-frame');
    });
    //]]>

    function ecwidSetPopupCentering(iframeSelector) {
        if (!iframeSelector) {
            if (console) console.log("Selector should be set");
            return;
        }
        var iframeElement = document.querySelector(iframeSelector);
        if (iframeElement === null) {
            if (console) console.log("Element not found by selector " + iframeSelector);
            return;
        }
        window.addEventListener('scroll', function(e) {
            sendCenteringSettings(iframeElement);
        });
        window.addEventListener('resize', function(e) {
            sendCenteringSettings(iframeElement);
        });
        sendCenteringSettings(iframeElement);
        function sendCenteringSettings(iframeElement) {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            var clientHeight = window.innerHeight;
            var data = {
                parentWindowVisibleHeight: clientHeight,
                visibleHeightAboveIframe: iframeElement.getBoundingClientRect().top
            };
            iframeElement.contentWindow.postMessage(JSON.stringify({data: data, method: 'setupPopupCentering'}), '*');
        }
    }
</script>


<iframe seamless id="ecwid-frame" frameborder="0" width="100%" height="700" scrolling="yes"></iframe>