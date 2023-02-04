<?php

namespace Modules\Slider\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterSliderSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
       /* $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('blug::blug.title.blugs'), function (Item $item) {
                $item->icon('fas fa-copy');
                $item->weight(10);
                $item->authorize(
                );
                $item->item(trans('blug::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.blug.category.create');
                    $item->route('admin.blug.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('blug.categories.index')
                    );
                });
                $item->item(trans('blug::posts.title.posts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.blug.post.create');
                    $item->route('admin.blug.post.index');
                    $item->authorize(
                        $this->auth->hasAccess('blug.posts.index')
                    );
                });


            });
        });*/
		
		$menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('slider::sliders.title'), function (Item $item) {
                $item->weight(10);
                $item->icon('fa fa-bars');
                $item->route('admin.slider.slider.index');
                
                $item->authorize(
                    /*$this->auth->hasAccess('slider.sliders.index')*/
                );
            });
        });

		
		

        return $menu;
    }
}
