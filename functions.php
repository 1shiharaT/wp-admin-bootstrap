<?php
/**
 * ボタンを出力
 *
 * @param array $options
 *
 */
function wpa_button( $options = array() ){
	$o = wp_parse_args(
		$options,
		array(
			'tag' => 'a',
			'type' => '',
			'href' => '',
			'text' => '',
			'brand' => 'primary',
			'size' => 'md'
		)
	);
	$type = ( $o['type'] ) ? 'type="'. $o['type'] .'"' : '';
	$href = ( $o['href'] ) ? 'href="' . $o['href'] . '"' : '';
	$button = '<%1$s %2$s %3$s class="btn btn-%4$s btn-%5$s">%6$s</%7$s>';
	$html = sprintf( $button, $o['tag'], $type, $href, $o['brand'], trim($o['size']), $o['text'], $o['tag'] );
	echo $html;
}

/**
 * font awesome
 * @param string $type
 */
function wpa_fa( $type = '' ){
	echo sprintf( '<i class="fa %s"></i>', $type );
}
