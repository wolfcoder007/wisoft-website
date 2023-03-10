<?php

namespace Modules\Testimonials\Listeners;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterTestimonialsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('testimonials::testimonials.title.testimonials'), function (Item $item) {
                $item->icon('fa fa-comment');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('testimonials::testimonials.title.testimonials'), function (Item $item) {
                    $item->icon('fa fa-comment');
                    $item->weight(0);
                    $item->append('admin.testimonials.testimonial.create');
                    $item->route('admin.testimonials.testimonial.index');
                    $item->authorize(
                        $this->auth->hasAccess('testimonials.testimonials.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
