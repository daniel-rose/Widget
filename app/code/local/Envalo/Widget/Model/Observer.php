<?php

class Envalo_Widget_Model_Observer
{
    /**
     * Add page specific handle
     *
     * @param $observer Varien_Event_Observer
     * @return $this
     */
    public function addPageSpecificHandle(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $page = $event->getData('page');

        if (!$page || !($page instanceof Mage_Cms_Model_Page)) {
            return $this;
        }

        $controller = $event->getData('controller_action');

        if ($controller instanceof Mage_Core_Controller_Front_Action
            && $controller->getLayout() instanceof Mage_Core_Model_Layout
            && $controller->getLayout()->getUpdate() instanceof Mage_Core_Model_Layout_Update
            && $page instanceof Mage_Cms_Model_Page
            && $page->getId()
        ) {
            $controller->getLayout()->getUpdate()->addHandle('cms_page_' . $page->getId());
        }

        return $this;
    }

    /**
     * Add handles
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addHandles(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $layoutHandles = $event->getData('layout_handles');

        if (!$layoutHandles || !($layoutHandles instanceof Varien_Object)) {
            return $this;
        }

        $specificEntitiesLayoutHandles = $event->getData('specific_entities_layout_handles');

        if (!$specificEntitiesLayoutHandles || !($specificEntitiesLayoutHandles instanceof Varien_Object)) {
            return $this;
        }

        $layoutHandles->setData('specific_cms_page', 'cms_page_view');
        $specificEntitiesLayoutHandles->setData('specific_cms_page', 'cms_page_{{ID}}');

        return $this;
    }

    /**
     * Add display on options
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addDisplayOnOptions(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $displayOnOptions = $event->getData('display_on_options');

        if (!$displayOnOptions || !($displayOnOptions instanceof Varien_Object)) {
            return $this;
        }

        $data = $displayOnOptions->getData();

        $data[count($data) - 1]['value'][] = array(
            'value' => 'specific_cms_page',
            'label' => Mage::helper('core')->jsQuoteEscape(Mage::helper('widget')->__('Specific CMS Pages'))
        );

        $displayOnOptions->setData($data);

        return $this;
    }

    /**
     * Add display on containers
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addDisplayOnContainers(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $container = $event->getData('container');

        if (!$container || !($container instanceof Varien_Object)) {
            return $this;
        }

        $container->setData('specific_cms_page', array(
            'label' => 'CMS Pages',
            'code' => 'pages',
            'name' => 'specific_cms_page',
            'layout_handle' => 'default,cms_page',
            'is_anchor_only' => 1,
            'product_type_id' => ''
        ));

        return $this;
    }

    /**
     * Add additional entities
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addAdditionalEntities(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $block = $event->getData('block');

        if (!$block || !($block instanceof Envalo_Widget_Block_Widget_Adminhtml_Shim)) {
            return $this;
        }

        $block->addAdditionalEntity('pages', array(
           'url' => Mage::getUrl('adminhtml/envalo_widget_cms_page_widget/ajaxChooser', array('_current' => true))
        ));

        return $this;
    }
}