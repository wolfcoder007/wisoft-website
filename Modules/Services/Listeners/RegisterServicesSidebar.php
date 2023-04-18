<?php

namespace Modules\Services\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterServicesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('services::services.title.services'), function (Item $item) {
                $item->icon('fa fa-gears');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('services::services.title.services'), function (Item $item) {
                    $item->icon('fa fa-gears');
                    $item->weight(0);
                    $item->append('admin.services.service.create');
                    $item->route('admin.services.service.index');
                    $item->authorize(
                        $this->auth->hasAccess('services.services.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
