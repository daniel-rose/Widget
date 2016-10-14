<?php

class Envalo_Widget_Adminhtml_Envalo_Widget_Cms_Page_WidgetController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Pages chooser Action
     */
    public function chooserAction()
    {
        $uniqId = $this->getRequest()->getParam('uniq_id');
        $massAction = $this->getRequest()->getParam('use_massaction', false);

        /* @var $pagesGrid Envalo_Widget_Block_Widget_Adminhtml_Cms_Page_Chooser */
        $pagesGrid = $this->getLayout()->createBlock('envalo_widget/adminhtml_cms_page_chooser', '', array(
            'id' => $uniqId,
            'use_massaction' => $massAction
        ));

        $html = $pagesGrid->toHtml();
        $this->getResponse()->setBody($html);
    }

    /**
     * Pages chooser Action (Ajax request)
     */
    public function ajaxChooserAction()
    {
        $selected = $this->getRequest()->getParam('selected', '');

        /* @var $chooser Envalo_Widget_Block_Widget_Adminhtml_Cms_Page_Chooser */
        $chooser = $this->getLayout()
            ->createBlock('envalo_widget/adminhtml_cms_page_chooser');

        $chooser->setName(Mage::helper('core')->uniqHash('cms_pages_grid_'))
            ->setUseMassaction(true)
            ->setSelectedPages(explode(',', $selected));

        /* @var $serializer Mage_Adminhtml_Block_Widget_Grid_Serializer */
        $serializer = $this->getLayout()->createBlock('adminhtml/widget_grid_serializer');
        $serializer->initSerializerBlock($chooser, 'getSelectedPages', 'selected_pages', 'selected_pages');

        $body = $chooser->toHtml() . $serializer->toHtml();

        Mage::getSingleton('core/translate_inline')->processResponseBody($body);

        $this->getResponse()->setBody($body);
    }

    /**
     * Check is allowed access to action
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/widget_instance');
    }
}