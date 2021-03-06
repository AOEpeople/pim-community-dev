<?php

namespace Akeneo\Pim\Structure\Bundle\Form\Type;

use Akeneo\Pim\Structure\Component\Model\GroupType as EntityGroupType;
use Akeneo\Pim\Structure\Component\Model\GroupTypeTranslation;
use Akeneo\Platform\Bundle\UIBundle\Form\Subscriber\DisableFieldSubscriber;
use Akeneo\Platform\Bundle\UIBundle\Form\Type\TranslatableFieldType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Type for group type form
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class GroupTypeType extends AbstractType
{
    /** @var string */
    protected $dataClass;

    /**
     * @param string $dataClass
     */
    public function __construct($dataClass)
    {
        $this->dataClass = $dataClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code');
        $builder->add(
            'label',
            TranslatableFieldType::class,
            [
                'field'             => 'label',
                'translation_class' => GroupTypeTranslation::class,
                'entity_class'      => EntityGroupType::class,
                'property_path'     => 'translations'
            ]
        );
        $builder->addEventSubscriber(new DisableFieldSubscriber('code'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->dataClass,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pim_enrich_grouptype';
    }
}
