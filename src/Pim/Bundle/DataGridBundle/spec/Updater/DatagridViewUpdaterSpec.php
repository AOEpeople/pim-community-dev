<?php

namespace spec\Pim\Bundle\DataGridBundle\Updater;

use Akeneo\Component\StorageUtils\Updater\ObjectUpdaterInterface;
use Pim\Bundle\DataGridBundle\Entity\DatagridView;
use Pim\Bundle\DataGridBundle\Updater\DatagridViewUpdater;
use PhpSpec\ObjectBehavior;
use Pim\Bundle\UserBundle\Entity\User;

class DatagridViewUpdaterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DatagridViewUpdater::class);
    }

    function it_is_a_object_updater()
    {
        $this->shouldImplement(ObjectUpdaterInterface::class);
    }

    function it_throws_an_exception_if_the_given_object_is_not_a_datagrid(User $user)
    {
        $this->shouldThrow('\InvalidArgumentException')->during('update', [$user, []]);
    }

    function it_updates_the_data_grid_property(DatagridView $datagridView, User $user)
    {
        $this->update($datagridView, [
            'owner' => $user,
            'datagrid_alias' => 'product-grid',
            'label' => 'My view',
            'columns' => 'name, price',
            'filters' => 'my filter as string',
        ])->shouldReturn($this);
    }
}
