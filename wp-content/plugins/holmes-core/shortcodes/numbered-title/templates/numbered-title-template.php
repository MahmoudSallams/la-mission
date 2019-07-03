<div class="mkdf-numbered-title-holder">
    <h5 class="mkdf-nt-title" <?php echo holmes_mkdf_get_inline_style($text_style) ?>>
        <?php echo esc_html($title); ?>
    </h5>
    <div class="mkdf-nt-line" <?php echo holmes_mkdf_get_inline_style($line_style) ?>></div>
    <h5 class="mkdf-nt-text" <?php echo holmes_mkdf_get_inline_style($text_style) ?>>
        <?php echo wp_kses_post($text); ?>
    </h5>
</div>