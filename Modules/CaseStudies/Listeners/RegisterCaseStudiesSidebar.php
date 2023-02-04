<?php

namespace Modules\CaseStudies\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterCaseStudiesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('casestudies::casestudies.title.casestudies'), function (Item $item) {
                $item->icon('fa fa-book');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('casestudies::casestudies.title.casestudies'), function (Item $item) {
                    $item->icon('fa fa-book');
                    $item->weight(0);
                    $item->append('admin.casestudies.casestudies.create');
                    $item->route('admin.casestudies.casestudies.index');
                    $item->authorize(
                        $this->auth->hasAccess('casestudies.casestudies.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
