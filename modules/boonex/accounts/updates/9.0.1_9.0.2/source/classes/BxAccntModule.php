<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 *
 * @defgroup    Accounts Accounts
 * @ingroup     UnaModules
 *
 * @{
 */

class BxAccntModule extends BxBaseModGeneralModule
{
    /**
     * Constructor
     */
    function __construct($aModule)
    {
        parent::__construct($aModule);

        $this->_oConfig->init($this->_oDb);
    }

	public function serviceGetMenuAddonManageTools()
	{
		bx_import('SearchResult', $this->_aModule);
        $sClass = $this->_aModule['class_prefix'] . 'SearchResult';
        $o = new $sClass();
        $o->fillFilters(array(
			'unconfirmed' => 1
        ));
        $o->unsetPaginate();

        return $o->getNum();
	}

    public function checkAllowedDelete(&$aDataEntry, $isPerformAction = false)
    {
    	if(isAdmin() && (int)$aDataEntry['id'] == getLoggedId())
    		return _t('_sys_txt_access_denied');

        // check ACL
        $aCheck = checkActionModule($this->_iProfileId, 'delete account', 'system', $isPerformAction);
        if($aCheck[CHECK_ACTION_RESULT] != CHECK_ACTION_RESULT_ALLOWED)
            return $aCheck[CHECK_ACTION_MESSAGE];

        return CHECK_ACTION_RESULT_ALLOWED;
    }

    public function checkAllowedMakeOperator(&$aDataEntry, $isPerformAction = false)
    {
    	$bAdmin = isAdmin();
    	if(!$bAdmin || (int)$aDataEntry['id'] == getLoggedId() || (int)$aDataEntry['role'] == 3)
    		return _t('_sys_txt_access_denied');

    	return CHECK_ACTION_RESULT_ALLOWED;
    }

	public function checkAllowedUnmakeOperator(&$aDataEntry, $isPerformAction = false)
    {
    	$bAdmin = isAdmin();
    	if(!$bAdmin || (int)$aDataEntry['id'] == getLoggedId() || (int)$aDataEntry['role'] != 3)
    		return _t('_sys_txt_access_denied');

    	return CHECK_ACTION_RESULT_ALLOWED;
    }
}

/** @} */
