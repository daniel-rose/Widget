<?php

class Envalo_Widget_Block_Widget_Adminhtml_Widget_Instance_Edit_Tab_Main_Layout extends Mage_Widget_Block_Adminhtml_Widget_Instance_Edit_Tab_Main_Layout
{
    /**
     * Generate array of parameters for every container type to create html template
     *
     * @return array
     */
    public function getDisplayOnContainers()
    {
        $container = new Varien_Object(parent::getDisplayOnContainers());

        Mage::dispatchEvent('widget_instance_layout_get_display_on_containers', array(
           'container' => $container
        ));

        return $container->getData();
    }

    /**
     * Retrieve Display On options array.
     * - Categories (anchor and not anchor)
     * - Products (product types depend on configuration)
     * - Generic (predefined) pages (all pages and single layout update)
     * - XXX
     *
     * @return array
     */
    protected function _getDisplayOnOptions()
    {
        $displayOnOptions = new Varien_Object(parent::_getDisplayOnOptions());

        Mage::dispatchEvent('widget_instance_layout_get_display_on_option', array(
            'display_on_options' => $displayOnOptions
        ));

        return $displayOnOptions->getData();
    }
}