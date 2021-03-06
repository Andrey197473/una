<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 *
 * @defgroup    UnaCore UNA Core
 * @{
 */

/**
 * This class allow different implementations for location field.
 *
 * Add record to sys_objects_location_field table, like you are doing this for Comments or Voting objects:
 * - object: your object name, usually it is in the following format - vendor prefix, underscore, module prefix;
 * - module: module name
 * - title: translatable title
 * - class_name: user defined class name which is derived from BxDolLocationField.
 * - class_file: the location of the user defined class, leave it empty if class is located in system folders.
 */
class BxDolLocationField extends BxDolFactory implements iBxDolFactoryObject
{
	protected $_oDb;
	protected $_sObject;
    protected $_aObject;

    /**
     * Constructor
     */
    protected function __construct($aObject)
    {
        parent::__construct();

        $this->_aObject = $aObject;
        $this->_sObject = $aObject['object'];

        $this->_oDb = new BxDolLocationFieldQuery($this->_aObject);
    }

   /**
     * Get object instance by object name
     * @param $sObject object name
     * @return object instance or false on error
     */
    public static function getObjectInstance($sObject)
    {
        if(isset($GLOBALS['bxDolClasses']['BxDolLocationField!' . $sObject]))
            return $GLOBALS['bxDolClasses']['BxDolLocationField!' . $sObject];

        $aObject = BxDolLocationFieldQuery::getLocationFieldObject($sObject);
        if (!$aObject || !is_array($aObject))
            return false;

        $sClass = 'BxDolLocationField';
        if(!empty($aObject['class_name'])) {
            $sClass = $aObject['class_name'];
            if(!empty($aObject['class_file']))
                require_once(BX_DIRECTORY_PATH_ROOT . $aObject['class_file']);
        }        

        $o = new $sClass($aObject);
        return ($GLOBALS['bxDolClasses']['BxDolLocationField!' . $sObject] = $o);
    }

    /**
     * Get current object name
     */
    public function getObjectName()
    {
        return $this->_aObject['object'];
    }

    public function genInputLocation (&$aInput, $oForm)
    {        
        $isManualInput = (int)(isset($aInput['manual_input']) && $aInput['manual_input']);
        if (!$isManualInput) {
            $aVars = array();
            $aInputField = $aInput;

            $aLocationIndexes = BxDolForm::$LOCATION_INDEXES;
            foreach ($aLocationIndexes as $sKey)
                $aVars[$sKey] = $this->getLocationVal($aInput, $sKey, $oForm);

            $aInputField['caption'] = _t('_sys_location_undefined');

            if ($this->getLocationVal($aInput, 'lat', $oForm) && $this->getLocationVal($aInput, 'lng', $oForm))
                $aInputField['checked'] = true;
            else
                $aInputField['checked'] = $oForm->getCleanValue($aInput['name'] . '_lat') && $oForm->getCleanValue($aInput['name'] . '_lng') ? 1 : 0;

            $sLocationString = _t('_sys_location_undefined');
            if ($aVars['country']) {
                $aCountries = BxDolFormQuery::getDataItems('Country');
                $sLocationString = ($aVars['street_number'] ? $aVars['street_number'] . ', ' : '') . ($aVars['street'] ? $aVars['street'] . ', ' : '') . ($aVars['city'] ? $aVars['city'] . ', ' : '') . ($aVars['state'] ? $aVars['state'] . ', ' : '') . $aCountries[$aVars['country']];
            }
            elseif ($aVars['lat'] || $aVars['lng']) {
                $sLocationString = $aVars['lat'] . ', ' . $aVars['lng'];
            }

            $aVars = array (
                'name' => $aInput['name'],
                'input' => $oForm->genInputSwitcher($aInputField),
                'id_status' => $oForm->getInputId($aInput) . '_status',
                'location_string' => $sLocationString,
            );

            $sRet = $oForm->getTemplate()->parseHtmlByName('form_field_location_plain_auto.html', $aVars);
        }
        else {
            // TODO: translations for placeholders
            $aFields = array(
                'lat' => array('type' => 'hidden'),
                'lng' => array('type' => 'hidden'),
                'street_number' => array('type' => 'text', 'ph' => 'Number'),
                'street' => array('type' => 'text', 'ph' => 'Street'),
                'city' => array('type' => 'text', 'ph' => 'City / Disctrict'),
                'state' => array('type' => 'text', 'ph' => 'State / Province'),
                'zip' => array('type' => 'text', 'ph' => 'Postal Code'),
                'country' => array('type' => 'select'),
            );

            $sRet = '';
            foreach ($aFields as $sKey => $a) {
                $aInputField = $aInput;
                $aInputField['name'] = $aInput['name'] . '_' . $sKey;
                $aInputField['type'] = $a['type'];
                $aInputField['value'] = $this->getLocationVal($aInput, $sKey, $oForm);            
                $aInputField['attrs']['placeholder'] = empty($a['ph']) ? '' : _t($a['ph']);
                if (isset($aInputField['attrs']['class']))
                    $aInputField['attrs']['class'] .= ' bx-form-input-location-' . $sKey;
                else
                    $aInputField['attrs']['class'] = 'bx-form-input-location-' . $sKey;
                if ('country' == $sKey) {
                    $aInputField['values'] = BxDolFormQuery::getDataItems('Country');
                    $sRet .= $oForm->genInputSelect($aInputField);
                }
                else {
                    $sRet .= $oForm->genInputStandard($aInputField);
                }
            }
        }
        return $sRet;
    }

    protected function getLocationVal ($aInput, $sIndex, $oForm) 
    {
        $aSpecificValues = $oForm->getSpecificValues();

        $s = $aInput['name'] . '_' . $sIndex;
        if (isset($aSpecificValues[$s]))
            return $aSpecificValues[$s];

        return $oForm->getCleanValue($s);
    }
}

/** @} */
