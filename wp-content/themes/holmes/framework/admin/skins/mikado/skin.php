<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class MikadoSkin extends HolmesMkdfSkinAbstract {
	
	/**
	 * Skin constructor. Hooks to holmes_mkdf_admin_scripts_init and holmes_mkdf_enqueue_admin_styles
	 */
	public function __construct() {
		$this->skinName = 'mikado';
		
		//hook to
		add_action( 'holmes_mkdf_admin_scripts_init', array( $this, 'registerStyles' ) );
		add_action( 'holmes_mkdf_admin_scripts_init', array( $this, 'registerScripts' ) );
		
		add_action( 'holmes_mkdf_enqueue_admin_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'holmes_mkdf_enqueue_admin_scripts', array( $this, 'enqueueScripts' ) );
		
		add_action( 'holmes_mkdf_enqueue_meta_box_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'holmes_mkdf_enqueue_meta_box_scripts', array( $this, 'enqueueScripts' ) );
		
		add_filter( 'holmes_mkdf_options_map_position', array( $this, 'setOptionsMapPosition' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

    /**
     * Method that registers skin scripts
     */
	public function registerScripts() {
		
		$this->scripts['mkdf-ui-admin-skin'] = array(
			'path'       => 'assets/js/mkdf-ui.js',
			'dependency' => array()
		);
		
		foreach ( $this->scripts as $scriptHandle => $script ) {
			holmes_mkdf_register_skin_script( $scriptHandle, $script['path'], $script['dependency'] );
		}
	}

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
	    $this->styles['mkdf-bootstrap'] = 'assets/css/mkdf-bootstrap.css';
        $this->styles['mkdf-page-admin'] = 'assets/css/mkdf-page.css';
        $this->styles['mkdf-options-admin'] = 'assets/css/mkdf-options.css';
        $this->styles['mkdf-meta-boxes-admin'] = 'assets/css/mkdf-meta-boxes.css';
        $this->styles['mkdf-ui-admin'] = 'assets/css/mkdf-ui/mkdf-ui.css';
        $this->styles['mkdf-forms-admin'] = 'assets/css/mkdf-forms.css';
        $this->styles['mkdf-import'] = 'assets/css/mkdf-import.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            holmes_mkdf_register_skin_style($styleHandle, $stylePath);
        }
    }

    /**
     * Method that renders options page
     *
     * @see MikadoSkin::getHeader()
     * @see MikadoSkin::getPageNav()
     * @see MikadoSkin::getPageContent()
     */
    public function renderOptions() {
        global $holmes_Framework;
        $tab    		= holmes_mkdf_get_admin_tab();
        $active_page 	= $holmes_Framework->mikadoOptions->getAdminPageFromSlug($tab);
        $current_theme 	= wp_get_theme();

        if ($active_page == null) return;
        ?>
        <div class="mkdf-options-page mkdf-page">
            <?php $this->getHeader($current_theme->get('Name'), $current_theme->get('Version')); ?>
            <div class="mkdf-page-content-wrapper">
                <div class="mkdf-page-content">
                    <div class="mkdf-page-navigation mkdf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page, $tab); ?>
                    </div>
                </div>
            </div>
        </div>
        <a id='back_to_top' href='#'>
            <span class="fa-stack">
                <span class="fa fa-angle-up"></span>
            </span>
        </a>
    <?php }

    /**
     * Method that renders header of options page.
     * @param string $themeName - theme name to display
     * @param string $themeVersion -  version to display
     * @param bool $showSaveButton - whether to show save button or not
     *
     * @see HolmesMkdfSkinAbstract::loadTemplatePart()
     */
    public function getHeader($themeName = '', $themeVersion, $showSaveButton = true) {
        $this->loadTemplatePart('header', array(
            'themeName' => $themeName,
            'themeVersion' => $themeVersion,
            'showSaveButton' => $showSaveButton)
        );
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $isImportPage if is import page highlighted that tab
     *
     * @see HolmesMkdfSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $isImportPage = false, $isBackupOptionsPage = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'isImportPage' => $isImportPage,
            'isBackupOptionsPage' => $isBackupOptionsPage
        ));
    }

    /**
     * Method that loads current page content
     *
     * @param HolmesMkdfAdminPage $page current page to load
     * @param string $tab current page slug
     * @param bool $showAnchors whether to show anchors template or not
     *
     * @see HolmesMkdfSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page, $tab, $showAnchors = true) {
        $this->loadTemplatePart('content', array(
            'page' => $page,
            'tab' => $tab,
            'showAnchors' => $showAnchors
        ));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

	/**
     * Method that loads content for import page
     */
    public function getBackupOptionsContent() {
        $this->loadTemplatePart('backup-options');
    }

    /**
     * Method that loads anchors and save button template part
     *
	 * @param HolmesMkdfAdminPage $page current page to load
     *
     * @see HolmesMkdfSkinAbstract::loadTemplatePart()
     */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));
    }

	/**
	 * Method that renders backup options page
	 *
	 * @see MikadoSkin::getHeader()
	 * * @see MikadoSkin::getPageNav()
	 * * @see MikadoSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="mkdf-options-page mkdf-page">
			<?php $this->getHeader(holmes_mkdf_get_theme_info_item('Name'), holmes_mkdf_get_theme_info_item('Version'), false); ?>
			<div class="mkdf-page-content-wrapper">
				<div class="mkdf-page-content">
					<div class="mkdf-page-navigation mkdf-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
    /**
     * Method that renders import page
     *
     * @see MikadoSkin::getHeader()
     * * @see MikadoSkin::getPageNav()
     * * @see MikadoSkin::getImportContent()
     */
    public function renderImport() { ?>
        <div class="mkdf-options-page mkdf-page">
            <?php $this->getHeader(holmes_mkdf_get_theme_info_item('Name'), holmes_mkdf_get_theme_info_item('Version'), false); ?>
            <div class="mkdf-page-content-wrapper">
                <div class="mkdf-page-content">
                    <div class="mkdf-page-navigation mkdf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
	
	function setOptionsMapPosition( $position, $map ) {
		
		switch ( $map ) {
			case 'fonts':
				$position = 2;
				break;
			case 'header':
				$position = 3;
				break;
			case 'sidearea':
				$position = 4;
				break;
			case 'search':
				$position = 5;
				break;
		}
		
		return $position;
	}
}
?>