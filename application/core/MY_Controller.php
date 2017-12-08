<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    var $userId = 0;
    var $userData = false;
    var $ajaxCall = false;
    var $pageData = array();
    var $settings = array();
    var $scripts = array();
    var $styles = array();
    var $master = 'master';
    var $_lang = 'en';

    public $isMobileDevice = false;

    /**
     * Constructor
     *
     * Calls the initialize() function
     */
    function __construct()
    {
        parent::__construct();

        $this->isLoggedIn();
        // $this->output->enable_profiler(TRUE);
        $this->load->model('global_model', 'mGlobal');
        $this->load->model('menu_model', 'mMenu');
        $this->load->model('lang_model', 'mLang');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $config_settings = $this->config->item('settings');
        $settings = $this->mGlobal->GetSettings();
        $this->settings = $settings + $config_settings;
        $this->_defaults();


        //getting product for cart
        $this->load->model('restaurants_menu');
        $session = $this->session->userdata('cart_data') ? $this->session->userdata('cart_data') : array();


        $this->pageData['productsCount'] = $session;

        $productIds = array();
        foreach ($session as $keyID => $product) {
            $productIds[] = $keyID;
        }

        if (!empty($productIds)) {
            $cartProducts = $this->restaurants_menu->getMenuItems($productIds);
        } else {
            $cartProducts = array();
        }

        $tmpMenuItems = array();
        foreach ($session as $keyID => $product) {
            foreach ($cartProducts as $cartProduct) {
                if ($keyID == $cartProduct->uid) {
                    $tmpMenuItems[] = $cartProduct;
                    break;
                }
            }
        }

        $cartTotal = 0;
        foreach ($cartProducts as $cartProduct) {

            if (isset($session[$cartProduct->uid])) {
                $cartTotal += ($session[$cartProduct->uid] * $cartProduct->price);
            }
        }

        $this->pageData['cartTotal'] = $cartTotal;
        $this->pageData['cartProducts'] = $tmpMenuItems;

        //end getting product for cart

        $this->ajaxCall = ($this->input->server('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest');
        log_message('debug', "My Controller Class Initialized");
    }

    function _addScript($fileName)
    {
        $this->scripts[$fileName] = 1;
    }

    function _addStyle($fileName)
    {
        $this->styles[$fileName] = 1;
    }

    function _getScripts()
    {
        $scripts = array_keys($this->scripts);
        foreach ($scripts as $script) {
            $this->pageData['scripts'] .= '<script type="text/javascript" language="javascript" src="' . site_url($script) . '"></script>';
            $this->pageData['scripts'] .= "\n";
        }
    }

    function _getStyles()
    {
        $styles = array_keys($this->styles);
        foreach ($styles as $style) {
            $this->pageData['styles'] .= '<link rel="stylesheet" media="screen" type="text/css" href="' . site_url($style) . '"/>';
            $this->pageData['styles'] .= "\n";
        }
    }

    function _renderPage()
    {
        $this->_getScripts();
        $this->_getStyles();
        $this->load->view($this->master, $this->pageData);
    }

    protected function isLoggedIn()
    {


        $this->load->model('login_model');

        if (
            $this->uri->segment(2) != 'subscribe' &&
            $this->uri->segment(2) != 'productajax' &&
            $this->uri->segment(2) != 'previewajax' &&
            $this->uri->segment(2) != 'remove_product' &&
            $this->uri->segment(2) != 'send_table_number' &&
            $this->uri->segment(2) != 'get_item_info' &&
            $this->uri->segment(2) != 'reset_ajax'
        ) {


            $segments = explode('/', $this->uri->uri_string());

            if (!empty($segments)) {
                $user_data = $this->login_model->getRestoUserBySlug($segments);
                $slug = isset($user_data->url) ? $user_data->url : '';
                $this->pageData['restaurant_id'] = $user_data->id;
                if (empty($user_data)) {
                    header("HTTP/1.0 404 Not Found");
                    die;
                } else {
                    $new_user = array(
                        'restaurant_id' => $user_data->id,
                    );
                    $this->session->set_userdata('user_id', $new_user);
                    $this->session->set_userdata('slug', $slug);

                    $this->pageData['resto_slug'] = $slug;
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                die;
            }

        }
    }

    function _currentView($view)
    {
        $this->pageData['current_view'] = $view;
    }

    function _defaults()
    {
        $DevelopmentParams = array();
        $Development = Development($DevelopmentParams);
        $copyright = '';
        if (!empty($Development['content'])) {
            $copyright = $Development['content'];
        }
        $this->pageData['copyright'] = $copyright;
        // set lang
        $lang_arrayTMP = $this->mLang->GetLangList();
        $lang_array = array();
        foreach ($lang_arrayTMP as $item) {
            $lang_array[$item->uid] = $item;
        }

//        $lang = $this->uri->segment(1) ? $this->uri->segment(1) : DEF_LANG;
        if ($this->input->get('lang')) {
            $lang = $this->input->get('lang');
            $this->session->set_userdata('lang', $this->input->get('lang'));
        } else if ($this->session->userdata('lang')) {
            $lang = $this->session->userdata('lang');
        } else {
            $lang = DEF_LANG;
        }

        if ($lang != '' && array_key_exists($lang, $lang_array)) {
            $this->_lang = $lang;
        }

        $currUrl = current_url();
        $lng = $this->uri->segment(1);

        $enUrl = site_url('/en');
        $amUrl = site_url('/am');
        $ruUrl = site_url('/ru');

        if (isset($lng) && $lng) {
            if ($this->_lang == 'en') {
                $enUrl = $currUrl;
                $beUrl = str_replace(base_url() . 'en', base_url() . 'be', $currUrl);
            }
            if ($this->_lang == 'be') {
                $beUrl = $currUrl;
                $enUrl = str_replace(base_url() . 'be', base_url() . 'en', $currUrl);
            }

        }

        $this->pageData['beUrl'] = $beUrl;
        $this->pageData['enUrl'] = $enUrl;

        $lang_url_array = array('am' => $amUrl, 'en' => $enUrl, 'ru' => $ruUrl);
        $this->pageData['lang_array'] = $lang_array;
        $this->pageData['lang_url_array'] = $lang_url_array;

        $slug = $this->uri->segment(2);
        $currentmenu = '';
        $currentmenu = $slug;
        if ($currentmenu == '' || $currentmenu == '/' || $currentmenu == 'home') {
            $currentmenu = '/';
        }

        // Main Menu
        $MainMenu = array();
        $MainMenu = $this->mMenu->GetMenuSectionByUrl('main-menu', $this->_lang);
        $MainMenu = RecursiveList($MainMenu, $parent = 1, $level = 0);
        $this->pageData['MainMenu'] = $MainMenu;

        $this->pageData['slug'] = $slug;
        $this->pageData['isActive'] = $currentmenu;
        $this->pageData['currentmenu'] = $currentmenu;
        $cid = 0;
        $content = new stdClass();
        $content->title = '';
        $content->text = '';

        $menuObj = array();
        $menuObj = $this->mMenu->GetPageByUrl($currentmenu, $this->_lang);
        $this->pageData['menuObj'] = $menuObj;

        if (isset($menuObj) && !empty($menuObj)) {
            $cid = $menuObj->cid;
            if (isset($cid) && $cid) {
                $content = $this->mMenu->GetContentById($cid, $this->_lang);
            }

            $this->pageData['page_title'] = $menuObj->title;
            $this->pageData['meta_title'] = $menuObj->meta_title;
            $this->pageData['meta_desc'] = $menuObj->meta_desc;
        }

        $labels = $this->mGlobal->GetAllNoStatus('labels', $this->_lang,0,0,array('type' => 'label'));
        $tmpLabels = new stdClass();
        foreach ($labels as $label) {
            $tmpLabels->{$label->key} = $label->text;
        }
        $this->pageData['labels'] = $tmpLabels;


        $this->load->library('mobile_detect/Mobile_Detect');
        $detect = new Mobile_Detect;
        if ($detect->isMobile() || $detect->isTablet()) {
            $this->isMobileDevice = true;
        }
//        $this->isMobileDevice = true;

        $this->pageData['cid'] = $cid;
        $this->pageData['content'] = $content;
        $this->pageData['current_view'] = 'default';
        $this->pageData['page_class'] = null;
        $this->pageData['styles'] = '';
        $this->pageData['scripts'] = '';
    }

    protected function _is_correct_url($lang_array)
    {
        if ($this->uri->segment(1) && $this->uri->segment(2)) {
            $isln = false;
            foreach ($lang_array as $key => $langItem) {
                if ($key == $this->uri->segment(1)) {
                    $isln = true;
                }
            }
            if (!$isln) {
                redirect('/');
            }
        }
    }

    private function Sort_Multidimension_Array(&$categories_tree)
    {
        if (!function_exists('cmp_by_optionNumber')) {
            function cmp_by_optionNumber($a, $b)
            {
                return $a["pos"] - $b["pos"];
            }
        }
        usort($categories_tree, "cmp_by_optionNumber");
        foreach ($categories_tree as &$v) {
            if (isset($v['children'])) {
                $this->Sort_Multidimension_Array($v['children']);
            }
        }
        return $categories_tree;
    }
}