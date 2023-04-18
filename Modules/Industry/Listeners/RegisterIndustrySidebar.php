<?php

namespace Modules\Industry\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIndustrySidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('industry::industries.title.industries'), function (Item $item) {
                $item->icon('fa fa-industry');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('industry::industries.title.industries'), function (Item $item) {
                    $item->icon('fa fa-industry');
                    $item->weight(0);
                    $item->append('admin.industry.industry.create');
                    $item->route('admin.industry.industry.index');
                    $item->authorize(
                        $this->auth->hasAccess('industry.industries.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
