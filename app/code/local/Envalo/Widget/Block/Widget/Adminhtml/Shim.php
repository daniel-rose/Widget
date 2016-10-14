<?php

class Envalo_Widget_Block_Widget_Adminhtml_Shim extends Mage_Adminhtml_Block_Template
{
    /**
     * @var array
     */
    protected $_additionalEntities = array();

    /**
     * Retrieve additional entities
     *
     * @return array
     */
    public function getAdditionalEntities()
    {
        return $this->_additionalEntities;
    }

    /**
     * Retrieve additional entities as json
     *
     * @return array
     */
    public function getAdditionalEntitiesAsJson()
    {
        return Mage::helper('core')->jsonEncode($this->_additionalEntities);
    }

    /**
     * Add additional entity
     *
     * @param $type
     * @param $data
     *
     * @return $this
     */
    public function addAdditionalEntity($type, $data)
    {
        $this->_additionalEntities[$type] = $data;
        return $this;
    }
}