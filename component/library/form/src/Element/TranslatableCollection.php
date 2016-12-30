<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use Doctrine\Common\Collections\Collection;
use Zend\Form\FormInterface;

class TranslatableCollection
    extends \WellCart\Form\Element\Collection
{
    /**
     * @var Collection
     */
    protected $languages;

    /**
     * Accepted options for Collection:
     * - languages_collection: Doctrine collection of Language objects
     *
     * @param array|Traversable $options
     *
     * @return TranslatableCollection
     */
    public function setOptions($options)
    {
        if (isset($options['languages_collection'])) {
            $languages = $options['languages_collection'];
            $this->setLanguages($languages);
            $options['count'] = $languages->count();
            $options['allow_add']
                = $options['allow_remove']
                = $options['should_create_template']
                = $options['create_new_objects'] = false;
        }
        parent::setOptions($options);
        return $this;
    }

    /**
     * Prepare the collection by adding a dummy template element if the user want one
     *
     * @param  FormInterface $form
     *
     * @return mixed|void
     */
    public function prepareElement(FormInterface $form)
    {
        parent::prepareElement($form);
        $languages = $this->getLanguages();
        $fieldsets = $this->getFieldsets();
        if ($languages === null
            || count($fieldsets) != $languages->count()
        ) {
            return;
        }

        $i = 0;
        $languagesCount = $languages->count();
        foreach ($languages as $language) {
            $fieldset = $fieldsets[$i];
            $object = $fieldset->getObject();
            $object->setLanguage($language);
            if ($languagesCount > 1) {
                $fieldset->setLabel($language->getName());
            }
            $languageElement = $fieldset->get('language');
            $languageElement->setValue($language->getId());
            $i++;
        }

    }

    /**
     * @return Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param Collection $languages
     *
     * @return TranslatableCollection
     */
    public function setLanguages(Collection $languages)
    {
        $this->languages = $languages;
        return $this;
    }


}