<?php
if (!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfFilter
 * 
 */
define('gf_FILTER_PATH', gf_APPS_PATH . '/filters');
define('gf_FILTER_PRE', 'pre');
define('gf_FILTER_POST', 'post');
define('gf_FILTER_EXTENSION', '.filter');

if(gfConfig::getConfig('logs') == 1) {
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_FILTER_PATH', gf_CORE_PATH, __FILE__, __LINE__, gf_FILTER_PATH));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_FILTER_PRE', gf_CORE_PATH, __FILE__, __LINE__, gf_FILTER_PRE));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_FILTER_POST', gf_CORE_PATH, __FILE__, __LINE__, gf_FILTER_POST));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_FILTER_EXTENSION', gf_CORE_PATH, __FILE__, __LINE__, gf_FILTER_EXTENSION));
}

class gfFilter {

    private $_oFilters = array();
    private $_oAutoFilter = array();
    private $_aConfigs = array();
    private $_aFilters = array();

    public function __construct() {
        $this->_runFilter();
    }

    private function _addFilterPre($sName) {
        require_once gf_FILTER_PATH . '/' . $sName . '.' . gf_FILTER_PRE . gf_FILTER_EXTENSION . '.php';
        $pre = $sName . gf_FILTER_PRE();
        $this->_oFilters['pre'][] = new $pre();
        $this->_aFilters['pre'][] = array('filter' => $sName);
    }

    private function _addFilterPost($sName) {
        require_once gf_FILTER_PATH . '/' . $sName . '.' . gf_FILTER_POST . gf_FILTER_EXTENSION . '.php';
        $post = $sName . gf_FILTER_POST();
        $this->_oFilters['post'][] = new $post();
        $this->_aFilters['post'][] = array('filter' => $sName);
    }

    private function _loadConfigOfAutoFilters() {
        include(gf_APPS_PATH . '/configs/filters.php');
        $this->_oAutoFilter = @$aFilters;
    }

    private function _addAutoFilterPre() {
        if (@count($this->_oAutoFilter['pre']) > 0) {
            foreach ($this->_oAutoFilter['pre'] as $v) {
                $this->_addFilterPre($v['filter']);
            }
        }
    }

    private function _addAutoFilterPost() {
        if (@count($this->_oAutoFilter['post']) > 0) {
            foreach ($this->_oAutoFilter['post'] as $v) {
                $this->_addFilterPost($v['filter']);
            }
        }
    }

    private function _loadConfigOfActionFilters() {
        require(gf_APPS_PATH . '/modules/' . gf::Router()->getController() . '/configs.php');
        $this->_aConfigs['in_action'] = @$aArrayOfFiltersInSelectAction;
        $this->_aConfigs['all_action'] = @$aFiltersInAllAction;
        $this->_aConfigs['block_in_action'] = @$aBlockAutoArrayOfFilterInSelectAction;
        $this->_aConfigs['block_all_action'] = @$aBlockAutoFiltersInAllAction;
    }

    private function _setToRunFiltersInActionPre() {
        if (isset($this->_aConfigs['block_all_action']['pre'])) {
            if (count($this->_aConfigs['block_all_action']['pre']) > 0 && count($this->_aFilters['pre']) > 0) {
                foreach ($this->_aConfigs['block_all_action']['pre'] as $v1) {
                    foreach ($this->_aFilters['pre'] as $k => $v2) {
                        if (@$v1['filter'] == @$v2['filter']) {
                            unset($this->_oFilters['pre'][$k]);
                            unset($this->_aFilters['pre'][$k]);
                        }
                    }
                }
            }
        }
        if (isset($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['pre'])) {
            if (count($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['pre']) > 0 && count($this->_aFilters['pre']) > 0) {
                foreach ($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['pre'] as $v3) {
                    foreach ($this->_aFilters['pre'] as $k1 => $v4) {
                        if (@$v3['filter'] == @$v4['filter']) {
                            unset($this->_oFilters['pre'][$k1]);
                            unset($this->_aFilters['pre'][$k1]);
                        }
                    }
                }
            }
        }
        if (isset($this->_aConfigs['all_action']['pre'])) {
            if (count($this->_aConfigs['all_action']['pre']) > 0) {
                foreach ($this->_aConfigs['all_action']['pre'] as $v5) {
                    $this->_addFilterPre($v5['filter']);
                }
            }
        }

        if (isset($this->_aConfigs['in_action'][gf::Router()->getAction()]['pre'])) {
            if (count($this->_aConfigs['in_action'][gf::Router()->getAction()]['pre']) > 0) {
                foreach ($this->_aConfigs['in_action'][gf::Router()->getAction()]['pre'] as $v6) {
                    $this->_addFilterPre(@$v6['filter']);
                }
            }
        }
    }

    private function _setToRunFiltersInActionPost() {
        if (isset($this->_aConfigs['block_all_action']['post'])) {
            if (!empty($this->_aConfigs['block_all_action']['post']) && count($this->_aFilters['post']) > 0) {
                foreach ($this->_aConfigs['block_all_action']['post'] as $v1) {
                    foreach ($this->_aFilters['post'] as $k => $v2) {
                        if (@$v1['filter'] == @$v2['filter']) {
                            unset($this->_oFilters['post'][$k]);
                            unset($this->_aFilters['post'][$k]);
                        }
                    }
                }
            }
        }
        if (isset($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['post'])) {
            if (count($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['post']) > 0 && count($this->_aFilters['post']) > 0) {
                foreach ($this->_aConfigs['block_in_action'][gf::Router()->getAction()]['post'] as $v3) {
                    foreach ($this->_aFilters['post'] as $k1 => $v4) {
                        if (@$v3['filter'] == @$v4['filter']) {
                            unset($this->_oFilters['post'][$k1]);
                            unset($this->_aFilters['post'][$k1]);
                        }
                    }
                }
            }
        }
        if (isset($this->_aConfigs['all_action']['post'])) {
            if (count($this->_aConfigs['all_action']['post']) > 0) {
                foreach ($this->_aConfigs['all_action']['post'] as $v5) {
                    $this->_addFilterPost($v5['filter']);
                }
            }
        }
        if (isset($this->_aConfigs['in_action'][gf::Router()->getAction()]['post'])) {
            if (count($this->_aConfigs['in_action'][gf::Router()->getAction()]['post']) > 0) {
                foreach ($this->_aConfigs['in_action'][gf::Router()->getAction()]['post'] as $v6) {
                    $this->_addFilterPost($v6['filter']);
                }
            }
        }
    }

    private function _runFilter() {
        $this->_loadConfigOfAutoFilters();
        $this->_addAutoFilterPre();
        $this->_addAutoFilterPost();
        $this->_loadConfigOfActionFilters();
        $this->_setToRunFiltersInActionPre();
        $this->_setToRunFiltersInActionPost();
    }

    public function runFilterPre() {
        $this->_runPre();
    }

    public function runFilterPost() {
        $this->_runPost();
    }

    private function _runPre() {
        if (@count($this->_oFilters['pre']) > 0) {
            foreach ($this->_oFilters['pre'] as $v) {
                $v->run();
            }
        }
    }

    private function _runPost() {
        if (@count($this->_oFilters['post']) > 0) {
            foreach ($this->_oFilters['post'] as $v) {
                $v->run();
            }
        }
    }

}
