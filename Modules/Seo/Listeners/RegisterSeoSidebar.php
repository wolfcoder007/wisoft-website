<?php

namespace Modules\Seo\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterSeoSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('seo::seos.title.seos'), function (Item $item) {
                $item->icon('fa fa-search-plus');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('seo::seos.title.seos'), function (Item $item) {
                    $item->icon('fa fa-search-plus');
                    $item->weight(0);
                    $item->append('admin.seo.seo.create');
                    $item->route('admin.seo.seo.index');
                    $item->authorize(
                        $this->auth->hasAccess('seo.seos.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
