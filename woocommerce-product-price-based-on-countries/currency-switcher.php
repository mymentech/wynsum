<?php
/**
 * Currency Switcher template
 *
 * @author 		oscargare
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wcpbc_currency_switcher_script' ) ) {

	function wcpbc_currency_switcher_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready( function( $ ){
			$('.wcpbc-widget-currency-switcher').on('change', 'select.currency-switcher', function(){
				$(this).closest('form').submit();
			} );
		} );
		</script>
		<?php
	}
}

add_action( 'wp_print_footer_scripts', 'wcpbc_currency_switcher_script' );

if ( $options ) : ?>
		
	<form method="post" class="wcpbc-widget-currency-switcher">		
		<select class="currency-switcher <?php echo $selected_country; ?>" name="wcpbc-manual-country">
			<?php foreach ($options as $key => $value) : ?>
				<option value="<?php echo $key?>" <?php selected($key, $selected_country ); ?> ><?php echo $value; ?></option>
			<?php endforeach; ?>
		</select>					
	</form>				

<?php endif; ?>