<?php

/*
Code to render and manage the settings page for the updater system.
Written by Chris Jean for iThemes.com
Version 1.0.0

Version History
	1.0.0 - 2013-04-11 - Chris Jean
		Release ready
*/


class Ithemes_Updater_Settings_Page {
	private $page_name = 'ithemes-licensing';
	
	private $path_url = '';
	private $self_url = '';
	private $messages = array();
	private $message_strings = array();
	private $errors = array();
	private $soft_errors = array();
	
	
	public function __construct() {
		require_once( dirname( __FILE__ ) . '/functions.php' );
		require_once( dirname( __FILE__ ) . '/api.php' );
		require_once( dirname( __FILE__ ) . '/keys.php' );
		
		
		$this->path_url = Ithemes_Updater_Functions::get_url( dirname( __FILE__ ) );
		
		list( $this->self_url ) = explode( '?', $_SERVER['REQUEST_URI'] );
		$this->self_url .= '?page=' . $this->page_name;
		
		
		add_action( 'ithemes_updater_settings_page_index', array( $this, 'index' ) );
		add_action( 'admin_print_styles', array( $this, 'add_styles' ) );
	}
	
	public function add_styles() {
		wp_enqueue_style( 'ithemes-updater-settings-page-style', "{$this->path_url}/css/settings-page.css" );
	}
	
	public function index() {
		$post_data = Ithemes_Updater_Functions::get_post_data( array( 'it-updater-username', 'it-updater-password', 'packages', 'action' ), true );
		
		if ( empty( $post_data['packages'] ) )
			$post_data['packages'] = array();
		
		
		$action = $post_data['action'];
		
		if ( 'license_packages' == $action )
			$this->license_packages( $post_data );
		else if ( 'unlicense_packages' == $action )
			$this->unlicense_packages( $post_data );
		else if ( 'save_settings' == $action )
			$this->save_settings();
		
		$this->list_packages( $action, $post_data );
	}
	
	private function get_error_explanation( $error, $package = '' ) {
		$code = $error->get_error_code();
		$package_name = Ithemes_Updater_Functions::get_package_name( $package );
		$message = '';
		
		switch( $code ) {
			case 'ITXAPI_Updater_Bad_Login':
				$message = __( 'Incorrect password. Please make sure that you are supplying your iThemes membership username and password details.', 'it-l10n-rotating-images' );
				break;
			case 'ITXAPI_Updater_Username_Unknown':
			case 'ITXAPI_Updater_Username_Invalid':
				$message = __( 'Invalid username. Please make sure that you are supplying your iThemes membership username and password details.', 'it-l10n-rotating-images' );
				break;
			case 'ITXAPI_Product_Package_Unknown':
				$message = sprintf( __( 'The licensing server reports that the %1$s (%2$s) product is unknown. Please contact support for assistance.', 'it-l10n-rotating-images' ), $package_name, $package );
				break;
			case 'ITXAPI_Updater_Too_Many_Sites':
				$message = sprintf( __( '%1$s could not be licensed since the membership account is out of available licenses for this product. You can unlicense the product on other sites or upgrade your membership to one with a higher number of licenses in order to increase the amount of available licenses.', 'it-l10n-rotating-images' ), $package_name );
				break;
			case 'ITXAPI_License_Key_Generate_Failed':
				$message = sprintf( __( '%s could not be licensed due to an internal error. Please try to license %s again at a later time. If this problem continues, please contact iThemes support.', 'it-l10n-rotating-images' ), $package_name );
				break;
		}
		
		if ( empty( $message ) ) {
			if ( ! empty( $package ) )
				$message = sprintf( __( 'An unknown error relating to the %1$s product occurred. Please contact iThemes support. Error details: %2$s', 'it-l10n-rotating-images' ), $package_name, $error->get_error_message() . " ($code)" );
			else
				$message = sprintf( __( 'An unknown error occurred. Please contact iThemes support. Error details: %s', 'it-l10n-rotating-images' ), $error->get_error_message() . " ($code)" );
		}
		
		return $message;
	}
	
	private function save_settings() {
		check_admin_referer( 'save_settings', 'ithemes_updater_nonce' );
		
		
		$settings_defaults = array(
			'show_on_sites' => false,
		);
		
		$settings = array();
		
		foreach ( $settings_defaults as $var => $val ) {
			if ( isset( $_POST[$var] ) )
				$settings[$var] = $_POST[$var];
			else
				$settings[$var] = $val;
		}
		
		
		$GLOBALS['ithemes-updater-object']->update_options( $settings );
		
		$this->messages[] = __( 'Settings saved', 'it-l10n-rotating-images' );
	}
	
	private function license_packages( $data ) {
		check_admin_referer( 'license_packages', 'ithemes_updater_nonce' );
		
		if ( empty( $data['username'] ) && empty( $data['password'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership username and password in order to license products.', 'it-l10n-rotating-images' );
		else if ( empty( $data['username'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership username in order to license products.', 'it-l10n-rotating-images' );
		else if ( empty( $data['password'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership password in order to license products.', 'it-l10n-rotating-images' );
		else if ( empty( $data['packages'] ) )
			$this->errors[] = __( 'You must select at least one product to license. Ensure that you select the products that you wish to license in the listing below.', 'it-l10n-rotating-images' );
		
		if ( ! empty( $this->errors ) )
			return;
		
		
		$response = Ithemes_Updater_API::activate_package( $data['username'], $data['password'], $data['packages'] );
		
		if ( is_wp_error( $response ) ) {
			$this->errors[] = $this->get_error_explanation( $response );
			
			return;
		}
		
		if ( empty( $response['packages'] ) ) {
			$this->errors[] = __( 'An unknown server error occurred. Please try to license your products again at another time.', 'it-l10n-rotating-images' );
			return;
		}
		
		
		uksort( $response['packages'], 'strnatcasecmp' );
		
		$success = array();
		$warn = array();
		$fail = array();
		
		foreach ( $response['packages'] as $package => $data ) {
			if ( preg_match( '/ \|\|\| \d+$/', $package ) )
				continue;
			
			$name = Ithemes_Updater_Functions::get_package_name( $package );
			
			if ( ! empty( $data['key'] ) )
				$success[] = $name;
			else if ( ! empty( $data['status'] ) && ( 'expired' == $data['status'] ) )
				$warn[$name] = __( 'Your product subscription has expired', 'it-l10n-rotating-images' );
			else
				$fail[$name] = $data['error']['message'];
		}
		
		
		if ( ! empty( $success ) )
			$this->messages[] = wp_sprintf( __( 'Successfully licensed %l.', 'it-l10n-rotating-images' ), $success );
		
		if ( ! empty( $fail ) ) {
			foreach ( $fail as $name => $reason )
				$this->errors[] = sprintf( __( 'Unable to license %1$s. Reason: %2$s', 'it-l10n-rotating-images' ), $name, $reason );
		}
		
		if ( ! empty( $warn ) ) {
			foreach ( $warn as $name => $reason )
				$this->soft_errors[] = sprintf( __( 'Unable to license %1$s. Reason: %2$s', 'it-l10n-rotating-images' ), $name, $reason );
		}
	}
	
	private function unlicense_packages( $data ) {
		check_admin_referer( 'unlicense_packages', 'ithemes_updater_nonce' );
		
		if ( empty( $data['username'] ) && empty( $data['password'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership username and password in order to remove licenses.', 'it-l10n-rotating-images' );
		else if ( empty( $data['username'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership username in order to remove licenses.', 'it-l10n-rotating-images' );
		else if ( empty( $data['password'] ) )
			$this->errors[] = __( 'You must supply an iThemes membership password in order to remove licenses.', 'it-l10n-rotating-images' );
		else if ( empty( $data['packages'] ) )
			$this->errors[] = __( 'You must select at least one license to remove. Ensure that you select the licenses that you wish to remove in the listing below.', 'it-l10n-rotating-images' );
		
		if ( ! empty( $this->errors ) )
			return;
		
		
		$response = Ithemes_Updater_API::deactivate_package( $data['username'], $data['password'], $data['packages'] );
		
		if ( is_wp_error( $response ) ) {
			$this->errors[] = $this->get_error_explanation( $response );
			
			return;
		}
		
		if ( empty( $response['packages'] ) ) {
			$this->errors[] = __( 'An unknown server error occurred. Please try to remove licenses from your products again at another time.', 'it-l10n-rotating-images' );
			return;
		}
		
		
		uksort( $response['packages'], 'strnatcasecmp' );
		
		$success = array();
		$fail = array();
		
		foreach ( $response['packages'] as $package => $data ) {
			if ( preg_match( '/ \|\|\| \d+$/', $package ) )
				continue;
			
			$name = Ithemes_Updater_Functions::get_package_name( $package );
			
			if ( isset( $data['status'] ) && ( 'inactive' == $data['status'] ) )
				$success[] = $name;
			else if ( isset( $data['error'] ) && isset( $data['error']['message'] ) )
				$fail[$name] = $data['error']['message'];
			else
				$fail[$name] = __( 'Unknown server error.', 'it-l10n-rotating-images' );
		}
		
		
		if ( ! empty( $success ) )
			$this->messages[] = wp_sprintf( _n( 'Successfully removed license from %l.', 'Successfully removed licenses from %l.', count( $success ), 'it-l10n-rotating-images' ), $success );
		
		if ( ! empty( $fail ) ) {
			foreach ( $fail as $name => $reason )
				$this->errors[] = sprintf( __( 'Unable to remove license from %1$s. Reason: %2$s', 'it-l10n-rotating-images' ), $name, $reason );
		}
	}
	
	public function list_packages( $action, $post_data ) {
		require_once( dirname( __FILE__ ) . '/packages.php' );
		$details = Ithemes_Updater_Packages::get_full_details();
		$packages = $details['packages'];
		
		$licensed = array();
		$unlicensed = array();
		$unrecognized = array();
		
		foreach ( $packages as $path => $data ) {
			$name = Ithemes_Updater_Functions::get_package_name( $data['package'] );
			$data['path'] = $path;
			
			if ( 'unlicensed' == $data['status'] )
				$unlicensed[$name] = $data;
			else if ( in_array( $data['status'], array( 'active', 'expired' ) ) )
				$licensed[$name] = $data;
			else
				$unrecognized[$name] = $data;
		}
		
		
		if ( ! empty( $this->messages ) ) {
			foreach ( $this->messages as $message )
				echo "<div class=\"updated fade\"><p><strong>$message</strong></p></div>\n";
		}
		
		if ( ! empty( $this->errors ) ) {
			foreach ( $this->errors as $error )
				echo "<div class=\"error\"><p><strong>$error</strong></p></div>\n";
		}
		
		if ( ! empty( $this->soft_errors ) ) {
			foreach ( $this->soft_errors as $error )
				echo "<div class=\"error\"><p><strong>$error</strong></p></div>\n";
		}
		
		
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'iThemes Licensing', 'it-l10n-rotating-images' ); ?></h2>
		
		<?php $this->list_licensed_products( $licensed, $post_data, $action ); ?>
		
		<?php $this->list_unlicensed_products( $unlicensed, $post_data, $action ); ?>
		
		<?php $this->list_unrecognized_products( $unrecognized ); ?>
		
		<?php $this->show_settings(); ?>
	</div>
<?php
		
	}
	
	private function show_settings() {
		if ( ! is_multisite() || ! is_network_admin() )
			return;
		
		
		$show_on_sites = $GLOBALS['ithemes-updater-object']->get_option( 'show_on_sites' );
		
?>
	<form id="posts-filter" enctype="multipart/form-data" method="post" action="<?php echo $this->self_url; ?>">
		<?php wp_nonce_field( 'save_settings', 'ithemes_updater_nonce' ); ?>
		
		<div id="ithemes-updater-settings">
			<h3 class="subtitle"><?php _e( 'Settings', 'it-l10n-rotating-images' ); ?></h3>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="show_on_sites"><?php _e( 'Licensing Page Access', 'it-l10n-rotating-images' ); ?></label>
						</th>
						<td>
							<?php $checked = ( $show_on_sites ) ? ' checked="checked"' : ''; ?>
							
							<label>
								<input id="show_on_sites" type="checkbox" name="show_on_sites" value="1" <?php echo $checked; ?>/>
								<?php _e( 'Show this licensing page on site dashboards', 'it-l10n-rotating-images' ); ?>
							</label>
							
							<p class="description"><?php _e( 'By default, this page only shows on the network dashboard. Enable the option above in order to have this page accessible on sites as well.', 'it-l10n-rotating-images' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			
			<p class="submit">
				<input id="save_settings" class="button button-primary" type="submit" value="<?php _e( 'Save Settings', 'it-l10n-rotating-images' ); ?>" />
				<input type="hidden" name="action" value="save_settings" />
			</p>
		</div>
	</form>
<?php
		
	}
	
	
	private function list_licensed_products( $products, $post_data, $action ) {
		if ( empty( $products ) )
			return;
		
		uksort( $products, 'strnatcasecmp' );
		
		$time = time();
		
		$headings = array(
			__( 'Product', 'it-l10n-rotating-images' ),
			__( 'Member', 'it-l10n-rotating-images' ),
			__( 'Expiration', 'it-l10n-rotating-images' ),
			__( 'Remaining Licenses', 'it-l10n-rotating-images' ),
		);
		
		if ( ( 'unlicense_packages' != $action ) || empty( $this->errors ) ) {
			$post_data = array(
				'username' => '',
				'password' => '',
				'packages' => array(),
			);
		}
		
?>
	<form id="posts-filter" enctype="multipart/form-data" method="post" action="<?php echo $this->self_url; ?>" autocomplete="off">
		<?php wp_nonce_field( 'unlicense_packages', 'ithemes_updater_nonce' ); ?>
		
		<div class="ithemes-updater-products" id="ithemes-updater-licensed">
			<h3 class="subtitle"><?php _e( 'Licensed Products', 'it-l10n-rotating-images' ); ?></h3>
			
			<table class="ithemes-updater-listing widefat">
				<thead>
					<tr>
						<th id="cb" class="manage-column column-cb check-column" scope="col">
							<label class="screen-reader-text" for="cb-select-all-1"><?php _e( 'Select All' ); ?></label>
							<label>
								<input id="cb-select-all-1" type="checkbox" />
							</label>
						</th>
						<th scope="col">
							<label for="cb-select-all-1"><?php _e( 'Product', 'it-l10n-rotating-images' ); ?></label>
						</th>
						<th scope="col"><?php _e( 'Member', 'it-l10n-rotating-images' ); ?></th>
						<th scope="col"><?php _e( 'Product Status', 'it-l10n-rotating-images' ); ?></th>
						<th scope="col"><?php _e( 'Expiration', 'it-l10n-rotating-images' ); ?></th>
						<th scope="col"><?php _e( 'Remaining Licenses', 'it-l10n-rotating-images' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $count = 0; ?>
					<?php foreach ( $products as $name => $data ) : ?>
						<?php
							if ( -1 == $data['total'] )
								$remaining = __( 'unlimited', 'it-l10n-rotating-images' );
							else
								$remaining = $data['total'] - $data['used'];
							
//							if ( 0 == $remaining )
//								$remaining .= ' <a class="button-secondary upgrade">' . __( 'Upgrade', 'it-l10n-rotating-images' ) . '</a>';
							
							
							$expiration = $this->get_expiration_string( $data['expiration'] );
							$expiration = '<time datetime="' . date( 'Y-m-d\TH:i:s\Z', $data['expiration'] ) . '">' . $expiration . '</time>';
							
							
							$time_left = $data['expiration'] - $time;
							$class = 'expiring';
							
							if ( $time_left > ( 86400 * 30 ) )
								$class = 'active';
							else if ( $time_left <= 0 )
								$class = 'expired';
							
							
							if ( 'expired' == $data['status'] ) {
								$class = 'expired';
								$remaining = '&nbsp;';
							}
							
							
							$status = ucfirst( $class );
							
							
							$check_id = "cb-select-{$data['package']}";
							
							
							$checked = ( in_array( $data['package'], $post_data['packages'] ) ) ? ' checked' : '';
						?>
						<tr class="<?php echo $class; ?>">
							<th class="check-column" scope="row">
								<label class="screen-reader-text" for="<?php echo $check_id; ?>"><?php printf( __( 'Select %s' ), $name ); ?></label>
								<label for="<?php echo $check_id; ?>">
									<input id="<?php echo $check_id ?>" name="packages[]" value="<?php echo $data['package']; ?>" type="checkbox"<?php echo $checked; ?>>
								</label>
							</th>
							<td>
								<label for="<?php echo $check_id; ?>"><?php echo $name; ?></label>
							</td>
							<td><?php echo $data['user']; ?></td>
							<td><?php echo $status; ?></td>
							<td><?php echo $expiration; ?></td>
							<td><?php echo $remaining; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<input type="text" name="it-updater-username" placeholder="iThemes Username" value="<?php echo esc_attr( $post_data['username'] ); ?>" autocomplete="off" />
							<input type="password" name="it-updater-password" placeholder="Password" value="<?php echo esc_attr( $post_data['password'] ); ?>" />
							<input class="button-primary" type="submit" name="submit" value="<?php _e( 'Remove Licenses', 'it-l10n-rotating-images' ); ?>" />
							<input type="hidden" name="action" value="unlicense_packages" />
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>
<?php
		
	}
	
	private function list_unlicensed_products( $products, $post_data, $action ) {
		if ( empty( $products ) )
			return;
		
		uksort( $products, 'strnatcasecmp' );
		
		if ( ( 'license_packages' != $action ) || empty( $this->errors ) ) {
			$post_data = array(
				'username' => '',
				'password' => '',
				'packages' => array(),
			);
			
			foreach ( $products as $name => $data )
				$post_data['packages'][] = $data['package'];
		}
		
?>
	<form id="posts-filter" enctype="multipart/form-data" method="post" action="<?php echo $this->self_url; ?>" autocomplete="off">
		<?php wp_nonce_field( 'license_packages', 'ithemes_updater_nonce' ); ?>
		
		<div class="ithemes-updater-products" id="ithemes-updater-unlicensed">
			<h3 class="subtitle"><?php _e( 'Unlicensed Products', 'it-l10n-rotating-images' ); ?></h3>
			
			<p><?php _e( 'The following products have not been licensed. Licensing a product gives you access to automatic updates from within WordPress.', 'it-l10n-rotating-images' ); ?></p>
			<p><?php _e( 'To license products, select the products you wish to license, enter your iThemes membership username and password, and press the License Products button.', 'it-l10n-rotating-images' ); ?></p>
			<p><?php printf( __( 'Need help? <a href="%s">Click here for a quick video tutorial</a>.', 'it-l10n-rotating-images' ), 'http://ithemes.com/2013/04/11/introducing-the-new-and-improved-ithemes-licensing-system/' ); ?></p>
			
			<table class="ithemes-updater-listing widefat">
				<thead>
					<tr>
						<th id="cb" class="manage-column column-cb check-column" scope="col">
							<label class="screen-reader-text" for="cb-select-all-2"><?php _e( 'Select All' ); ?></label>
							<label>
								<input id="cb-select-all-2" type="checkbox"<?php if ( count( $post_data['packages'] ) == count( $products ) ) echo ' checked'; ?> />
							</label>
						</th>
						<th scope="col">
							<label for="cb-select-all-2"><?php _e( 'Product', 'it-l10n-rotating-images' ); ?></label>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $products as $name => $data ) : ?>
						<?php
							$check_id = "cb-select-{$data['package']}";
							
							
							if ( 'license_packages' == $action )
								$checked = ( in_array( $data['package'], $post_data['packages'] ) ) ? ' checked' : '';
							else
								$checked = ' checked';
						?>
						<tr>
							<th class="check-column" scope="row">
								<label class="screen-reader-text" for="<?php echo $check_id; ?>"><?php printf( __( 'Select %s' ), $name ); ?></label>
								<label for="<?php echo $check_id; ?>">
									<input id="<?php echo $check_id; ?>" name="packages[]" value="<?php echo $data['package']; ?>" type="checkbox" <?php echo $checked; ?>>
								</label>
							</th>
							<td>
								<label for="<?php echo $check_id; ?>"><?php echo $name; ?></label>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">
							<input type="text" name="it-updater-username" placeholder="iThemes Username" value="<?php echo esc_attr( $post_data['username'] ); ?>" autocomplete="off" />
							<input type="password" name="it-updater-password" placeholder="Password" value="<?php echo esc_attr( $post_data['password'] ); ?>" />
							<input class="button-primary" type="submit" name="submit" value="<?php _e( 'License Products', 'it-l10n-rotating-images' ); ?>" />
							<input type="hidden" name="action" value="license_packages" />
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>
<?php
		
	}
	
	private function list_unrecognized_products( $products ) {
		if ( empty( $products ) )
			return;
		
		uksort( $products, 'strnatcasecmp' );
		
?>
	<div class="ithemes-updater-products" id="ithemes-updater-unrecognized">
		<h3 class="subtitle"><?php _e( 'Unrecognized Products', 'it-l10n-rotating-images' ); ?></h3>
		
		<p><?php _e( 'The following products were not recognized by the licensing system. This can be due to a bug in the product code, a temporary server issue, or because the product is no longer supported.', 'it-l10n-rotating-images' ); ?></p>
		<p><?php printf( __( 'Please check this page again at a later time to see if the problem resolves itself. If the product remains, please contact <a href="%s">iThemes support</a> and provide them with the details given below.', 'it-l10n-rotating-images' ), 'http://ithemes.com/forum/' ); ?></p>
		
		<table class="ithemes-updater-listing widefat">
			<thead>
				<tr>
					<th scope="col"><?php _e( 'Product', 'it-l10n-rotating-images' ); ?></th>
					<th scope="col"><?php _e( 'Type', 'it-l10n-rotating-images' ); ?></th>
					<th scope="col"><?php _e( 'Package', 'it-l10n-rotating-images' ); ?></th>
					<th scope="col"><?php _e( 'Version', 'it-l10n-rotating-images' ); ?></th>
					<th scope="col"><?php _e( 'Server Response', 'it-l10n-rotating-images' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $products as $name => $data ) : ?>
					<?php
						if ( ( 'error' == $data['status'] ) && ( ! empty( $data['error']['message'] ) ) )
							$response = "{$data['error']['message']} ({$data['error']['code']})";
						else
							$response = __( 'Unknown Error', 'it-l10n-rotating-images' );
					?>
					<tr>
						<td><?php echo $name; ?></td>
						<td><?php echo $data['type']; ?></td>
						<td><?php echo $data['package']; ?></td>
						<td><?php echo $data['installed']; ?></td>
						<td><?php echo $response; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php
		
	}
	
	private function get_expiration_string( $expiration_timestamp ) {
		$time = time();
		
		$time_left = $expiration_timestamp - $time;
		
		$expired = false;
		
		if ( $time_left < 0 ) {
			$expired = true;
			$time_left = abs( $time_left );
		}
		
		if ( $time_left > ( 86400 * 30 ) )
			$expiration = date( 'Y-m-d', $expiration_timestamp );
		else {
			if ( $time_left > 86400 )
				$expiration = sprintf( _n( '%d day', '%d days', intval( $time_left / 86400 ), 'it-l10n-rotating-images' ), intval( $time_left / 86400 ) );
			else if ( $time_left > 3600 )
				$expiration = sprintf( _n( '%d hour', '%d hours', intval( $time_left / 3600 ), 'it-l10n-rotating-images' ), intval( $time_left / 3600 ) );
			else if ( $time_left > 60 )
				$expiration = sprintf( _n( '%d minute', '%d minutes', intval( $time_left / 60 ), 'it-l10n-rotating-images' ), intval( $time_left / 60 ) );
			else
				$expiration = sprintf( _n( '%d second', '%d seconds', $time_left, 'it-l10n-rotating-images' ), intval( $time_left / 60 ) );
			
			if ( $expired )
				$expiration = sprintf( __( '%s ago', 'it-l10n-rotating-images' ), $expiration );
		}
		
		return $expiration;
	}
}


new Ithemes_Updater_Settings_Page();
