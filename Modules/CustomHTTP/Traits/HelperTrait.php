<?php
/**
 * Helpler Trait
 *
 * General Common functions that can be used anywhere
 *
 * @author Mudassar Ali <sahil_bwp@yahoo.com>
 * @version $Revision: 1.3 $
 * @access public
 * @see https://github.com/f9webltd/laravel-api-response-helpers
 */

namespace Modules\CustomHTTP\Traits;

use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Menu\Repositories\MenuRepository;
use Modules\Menu\Services\MenuRenderer;
use Nwidart\Menus\Facades\Menu;

trait HelperTrait
{

    /**
     * @var MenuRepository
     */
    private $menu;
    /**
     * @var MenuItemRepository
     */
    private $menuItem;
    /**
     * @var MenuRenderer
     */
    private $menuRenderer;

    public $menuTree;

    public function __construct(MenuRepository $menu, MenuItemRepository $menuItem, MenuRenderer $menuRenderer)
    {
        $this->menu = $menu;
        $this->menuItem = $menuItem;
        $this->menuRenderer = $menuRenderer;
        $this->menuTree = [];
    }

    /**
     * @param string $key
     */
    public function getMenuByKey($key = "Primary Menu")
    {
        $this->menuTree = [];
        $menu = $this->menu->where('name', $key)->first();
        $menuItems = $this->menuItem->getTreeForMenu($menu->id);
        foreach ($menuItems as $menuItem) {
            $this->menuTree[] = [
                'id' => $menuItem->id,
                'isRoot' => $menuItem->isRoot(),
                'icon' => $menuItem->icon,
                'title' => $menuItem->title,
                'uri' => $menuItem->uri,
                'target' => $menuItem->target,
                'position' => $menuItem->position,
                'class' => $menuItem->class,
                'hasChildren' => count($menuItem->items),
                'children' => $this->getChildMenuItems($menuItem, $menuItem->items),
            ];
//            if(count($menuItem->items)){
//                $this->getChildMenuItems($menuItem, $menuItem->items);
//            }
        }
        return $this->menuTree;

    }

    private function getChildMenuItems($menu, $items)
    {
        $child = [];
        foreach ($items as $item) {
            $child [] = [
                'id' => $item->id,
                'isRoot' => $item->isRoot(),
                'icon' => $item->icon,
                'title' => $item->title,
                'uri' => $item->uri,
                'target' => $item->target,
                'position' => $item->position,
                'class' => $item->class,
                'hasChildren' => count($item->items),
                'children' => $this->getChildMenuItems($menu, $item->items),
            ];
        }
        return $child;
    }

//    private function getChildMenuItems1($menu, $items)
//    {
//        foreach ($items as $item) {
//            $this->menuTree[$menu->id]['children' ][] = [
//                'id' => $item->id,
//                'isRoot' => $item->isRoot(),
//                'icon' => $item->icon,
//                'title' => $item->title,
//                'uri' => $item->uri,
//                'target' => $item->target,
//                'position' => $item->position,
//                'class' => $item->class,
//                'hasChildren' => count($item->items),
//            ];
//            if(count($item->items)){
//                $this->getChildMenuItems($menu, $item->items);
//            }
//        }
//    }
}