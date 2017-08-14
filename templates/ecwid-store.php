<?php snippet('header'); ?>
<script>
    window.ec = window.ec || Object();
    window.ec.config = window.ec.config || Object();
    window.ec.config.enable_canonical_urls = true;
    window.ec.config.chameleon = window.ec.config.chameleon || Object();
    window.ec.config.chameleon.font = "auto";
    window.ec.config.chameleon.colors = "auto";			
    window.ec.config.storefrontUrls = window.ec.config.storefrontUrls || {};
    window.ec.config.storefrontUrls.cleanUrls = true;
    
    window.ec.config.baseUrl = '<?php echo Url::path(Url::makeAbsolute($page->uid())); ?>';
</script>
<main class="main" role="main">
    <div>
        <script type="text/javascript" src="https://app.ecwid.com/script.js?<?php echo \Ecwid::get('storeID'); ?>&data_platform=kirby" charset="utf-8"></script>

        <?php $widgets = $page->widgets()->split(); ?>
        
		<?php if (in_array('search', $widgets)): ?>
            <div id="ecwid-search-<?php echo \Ecwid::get('storeID'); ?>"></div>
            <script type="text/javascript"> xSearch("id=ecwid-search-<?php echo \Ecwid::get('storeID'); ?>"); </script>
		<?php endif; ?>
        
        <?php if (in_array('categories', $widgets)): ?>
        <div id="ecwid-categories-<?php echo \Ecwid::get('storeID'); ?>"></div>    
        <script type="text/javascript"> xCategoriesV2("id=ecwid-categories-<?php echo \Ecwid::get('storeID'); ?>"); </script>
        <?php endif; ?>

		<?php if (in_array('minicart', $widgets)): ?>
            <div id="ecwid-minicart-<?php echo \Ecwid::get('storeID'); ?>"></div>
            <script type="text/javascript"> xMinicart("layout=MiniAttachToProductBrowser"); </script>
		<?php endif; ?>

        <div id="my-store-<?php echo \Ecwid::get('storeID'); ?>"></div>

        <script type="text/javascript"> xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-2662085");</script>
    </div>
</main>
<?php snippet('footer'); ?>