<?php

namespace Become\Supplier\Block\Adminhtml\Supplier\Edit\Tab;

class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Framework\DataObjectFactory
     */
    protected $_objectFactory;

    /**
     * @var \Magento\Catalog\Model\Category\Attribute\Source\Page
     */    
   // protected $_brand;

    /**
     * @var \Vicomage\Brand\Model\Shopbrand
     */

    protected $shopsupplier;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Become\Supplier\Model\Shopsupplier $shopsupplier,
        //\Vicomage\Brand\Model\System\Config\Brand $brand,
        array $data = []
    ) {
        $this->_objectFactory = $objectFactory;
        $this->_shopsupplier = $shopsupplier;
       // $this->_brand   = $brand;
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * prepare layout.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
        return $this;
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('shopsupplier');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('magic_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Supplier Information')]);

        if ($model->getId()) {
            $fieldset->addField('shop_supplier_id', 'hidden', ['name' => 'shop_supplier_id']);
        }

        $fieldset->addField('personal_name', 'text',
            [
                'label' => __('Name'),
                'title' => __('Name'),
                'name'  => 'personal_name',
                'required' => true,
            ]
        );

        $fieldset->addField('email', 'text',
            [
                'label' => __('Email'),
                'title' => __('Email'),
                'name'  => 'email',
                'required' => false,
            ]
        );


        // $fieldset->addField('meta_key', 'text',
            // [
                // 'label' => __('Meta Keywords'),
                // 'title' => __('Meta Keywords'),
                // 'name'  => 'meta_key',
                // 'required' => false,
            // ]
        // );

        $fieldset->addField('phone_number', 'text',
            [
                'label' => __('Phone'),
                'title' => __('Phone'),
                'name'  => 'phone_number',
                'required' => false,
            ]
        );

        // $fieldset->addField('additionalcategory', 'select',
            // [
                // 'label' => __('Organization'),
                // 'title' => __('Organization'),
                // 'name' => 'additionalcategory',
                // 'options' => Organization::getAvailableCategory(),
            // ]
        // );

        $fieldset->addField('additionalname', 'text',
            [
                'label' => __('Additional Name'),
                'title' => __('Additional Name'),
                'name'  => 'additionalname',
                'required' => false,
            ]
        );
		
		$fieldset->addField('files_name_url', 'image',
            [
                'label' => __('Files'),
                'title' => __('Files'),
                'name'  => 'files_name_url',
                'required' => false,
            ]
        );


        $form->addValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return mixed
     */
    public function getShopsupplier()
    {
        return $this->_coreRegistry->registry('shopsupplier');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getPageTitle()
    {
        return $this->getShopsupplier()->getId()
            ? __("Edit Supplier '%1'", $this->escapeHtml($this->getShopsupplier()->getTitle())) : __('New Supplier');
    }

    /**
     * Prepare label for tab.
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * Prepare title for tab.
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
