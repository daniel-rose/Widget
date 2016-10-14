<?php

class Envalo_Widget_Model_Widget_Widget_Instance extends Mage_Widget_Model_Widget_Instance
{
    /**
     * Internal Constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $layoutHandles = new Varien_Object($this->_layoutHandles);
        $specificEntitiesLayoutHandles = new Varien_Object($this->_specificEntitiesLayoutHandles);

        Mage::dispatchEvent('widget_instance_init_after', array(
            'layout_handles' => $layoutHandles,
            'specific_entities_layout_handles' => $specificEntitiesLayoutHandles
        ));

        $this->_layoutHandles = $layoutHandles->getData();
        $this->_specificEntitiesLayoutHandles = $specificEntitiesLayoutHandles->getData();
    }
}