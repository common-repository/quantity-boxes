<?php
/*
Plugin Name: QuantityBoxes
Plugin URI: http://extend.thecartpress.com/ecommerce-plugins/quantity-boxes/
Description: QuantityBoxes for WordPress
Version: 1.0.0
Author: TheCartPress team
Author URI: http://thecartpress.com
License: GPL
Parent: thecartpress
*/

/**
 * This file is part of TheCartPress-QuantityBoxes.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class TCPQuantityBoxes {
	function __construct() {
		add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
	}
	
	function wp_footer() { ?>
<script type="text/javascript">
var browser = jQuery.browser;
if ( browser.mozilla || browser.msie ) {
	jQuery( ':input[type="number"]' ).each( function() {
		var input = jQuery(this);
		var div = jQuery( '<div class="tcp-quantity"></div>' );
		input.before( div );
		div.css( {
			'position'		: 'relative',
			'display'		: 'block',
			'padding-right'	: '4px',
			'padding-left'	: '2px',
			'float' 		: 'left',
			'width' 		: input.outerWidth(),
			'border': '1px solid #808080',
			'-moz-border-radius': '5px',
			'border-radius'	: '5px',
		} );
		input.css( 'border', '0px' );
		input.appendTo( div );
		div.append( '<img src="<?php echo plugins_url( 'images/inc.png', __FILE__ ); ?>" class="tcp-quantity-inc tcp-quantity-button"/><img src="<?php echo plugins_url( 'images/dec.png', __FILE__ ); ?>" class="tcp-quantity-dec tcp-quantity-button" />' );
	} );

	jQuery( '.tcp-quantity-button' ).click( function() {
		var button = jQuery(this);
		var input = button.parent().find( ':input[type="number"]' );
		var oldValue = input.val();
		var step = input.attr( 'step' );
		if ( ! step ) step = 1;
		else step = parseFloat( step );
		var min = input.attr( 'min' );
		if ( ! min ) min = 0;
		else min = parseFloat( min );
		if ( button.hasClass( 'tcp-quantity-inc' ) ) {
			var newVal = parseFloat( oldValue ) + step;
		} else if ( oldValue > min ) {
			var newVal = parseFloat( oldValue ) - step;
		} else {
			newVal = min;
		}
		if ( isNaN( newVal ) ) newVal = min;
		input.val( newVal );
	} );

	jQuery( '.tcp-quantity' ).each( function() {
		var div = jQuery( this );
		var input = div.find( ':input[type="number"]' );
		var left = input.outerWidth() + 'px';
		var css = {
			'position'	: 'absolute',
			'top'		: '3px',
			'left'		: left,
			'cursor' 	: 'pointer',
		}
		div.find( '.tcp-quantity-inc' ).each( function() {
			jQuery(this).css( css );
		} );
		div.find( '.tcp-quantity-dec' ).each( function() {
			css['top'] = input.outerHeight() - 8 + 'px';
			jQuery(this).css( css );
		} );
	} );
}
</script>
<?php }
}

new TCPQuantityBoxes();
?>