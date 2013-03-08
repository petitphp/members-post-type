<?php
class MPT_Admin_Main {

	public function __construct( ) {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts' ), 10, 1 );
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
	}

	public static function admin_enqueue_scripts( $hook ) {
		global $post;

		if ( in_array( $hook, array( 'edit.php', 'post-new.php' ) ) && isset( $_GET['post_type'] ) && $_GET['post_type'] == MPT_CPT_NAME || in_array( $hook, array( 'post.php' ) ) && isset( $post ) && $post->post_type == MPT_CPT_NAME ) {
			wp_enqueue_style( MPT_CPT_NAME . '-admin', MPT_URL . '/assets/css/admin.css', array( ), MPT_VERSION, 'all' );
		}
	}

	public static function admin_menu( ) {
		add_options_page( __('Members', 'mpt'), __('Members', 'mpt'), 'manage_options', 'mpt_users_settings', array( __CLASS__, 'render_page_settings' ) );
	}

	public static function render_page_settings() {
		$active_tab = (isset( $_GET['tab'] ) ) ? $_GET['tab'] : '';
		include (MPT_DIR . '/views/admin/page-settings.php');
	}
	
}