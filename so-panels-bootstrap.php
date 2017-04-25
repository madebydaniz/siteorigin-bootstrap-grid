<?php

class SO_Panels_Bootstrap {

	public function __construct()
	{
		add_filter( 'siteorigin_panels_settings_defaults', array($this, 'settings_defaults_bootstrap'), 1 );
		add_filter( 'siteorigin_panels_settings_fields', array($this, 'settings_fields_bootstrap'), 20 );

		add_action( 'init', array($this, 'load_includable_files' ) );

	}

	function settings_defaults_bootstrap ($defaults) {
		// enable bootstrap grid by default
		$defaults['bootstrap-grid'] = true;
		$defaults['bootstrap-assets'] = true;
		$defaults['grid-options'] = 'col-md';
		return $defaults;
	}
	function settings_fields_bootstrap( $fields ){

		$fields['grid'] = array(
			'title' => __('Bootstrap Grid', 'siteorigin-panels'),
			'fields' => array(),
		);
		$fields['grid']['fields']['bootstrap-grid'] = array(
			'type' => 'checkbox',
			'label' => __('Bootstrap Grid', 'siteorigin-panels'),
			'description' => __('Use Bootstrap grid instead of the default grid', 'siteorigin-panels'),
		);

		$fields['grid']['fields']['bootstrap-assets'] = array(
			'type'        => 'checkbox',
			'label'       => __( 'Include Bootstrap Assets', 'siteorigin-panels' ),
			'description' => __( 'Include Bootstrap core files, only enable if you are not already including Bootstrap in your theme.', 'siteorigin-panels' ),
		);

		$fields['grid']['fields']['grid-options'] = array(
			'type' => 'select',
			'label' => __('Default Grid Option', 'siteorigin-panels'),
			'options' => array(
				'col-xs' => 'col-xs',
				'col-sm' => 'col-sm',
				'col-md' => 'col-md',
				'col-lg' => 'col-lg',
			),
			'description' => __('The default grid column to be used. Look at <a href="http://getbootstrap.com/css/#grid-options">Grid Options</a> for more details.', 'siteorigin-panels'),
		);

		return $fields;
	}

	function load_includable_files() {

		if (function_exists('siteorigin_panels_setting')) {
			if ( siteorigin_panels_setting( 'bootstrap-grid' )) {

				require_once plugin_dir_path( __FILE__ ) . 'includes/backend/hooks.php';
				require_once plugin_dir_path( __FILE__ ) . 'includes/backend/functions.php';
				require_once plugin_dir_path( __FILE__ ) . 'includes/frontend/hooks.php';
				require_once plugin_dir_path( __FILE__ ) . 'includes/frontend/functions.php';


			}
		}


	}

} new SO_Panels_Bootstrap();
