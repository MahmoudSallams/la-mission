<?php if(holmes_mkdf_core_plugin_installed()) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('holmes_mkdf_get_like') ) holmes_mkdf_get_like(); ?>
    </div>
<?php } ?>