<?php
$labels  = array();
$dataset = array();
foreach ( $graph_items as $item ) {
	$temp              = array();
	$labels[]          = $item['label'];
	$temp['fillColor'] = $item['color'];
	$temp['data']      = explode( ',', $item['values'] );
	$temp['label']     = false;
	$dataset[]         = $temp;
}
$id = mt_rand( 1000, 9999 );
?>
<div class="mkdf-line-graph-holder">
    <div class="mkdf-lg">
        <canvas class="mkdf-canvas" id="<?php echo 'lineGraph' . $id; ?>"
                height="<?php echo esc_html( $height ) ?>" width="<?php echo esc_html( $width ) ?>">
        </canvas>
    </div>
    <div class="mkdf-lg-legend">
        <ul>
			<?php foreach ( $graph_items as $item ): ?>
                <li>
                    <div class="mkdf-legend-item">
                        <div class="mkdf-lg-item-color" style="background-color:<?php echo esc_html( $item['color'] ) ?>;"></div>
                        <h5>
							<?php echo esc_html( $item['label'] ) ?>
                        </h5>
                    </div>
                </li>
			<?php endforeach; ?>
        </ul>
    </div>
    <div class="mkdf-lg-data" data-labels='<?php echo json_encode( $labels ); ?>'
            data-dataset='<?php echo json_encode( $dataset ); ?>'
            data-id="<?php echo esc_html( $id ); ?>"
            data-scale-steps="<?php echo esc_html( $scale_steps ) ?>"
            data-scale-steps-width="<?php echo esc_html( $scale_steps_width ) ?>">
    </div>
</div>