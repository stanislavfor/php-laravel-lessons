<?php

namespace App\Admin\Widgets;

use App\Models\Category;
use Arrilot\Widgets\AbstractWidget;

class CategoriesWidget extends AbstractWidget
{
    protected $config = [];

    public function run()
    {
        $count = Category::count();

        return view('voyager::dimmer', array_merge($this->config, [
            'icon' => 'voyager-file-text',
            'title' => 'Счетчик категорий',
            'text' => "Количество категорий: {$count}",
            'button' => [
                'text' => 'Показать категории',
                'link' => 'admin/categories'
            ],
            'image' => 'storage/voyager.jpg',
        ]));
    }

    public function shouldBeDisplayed()
    {
        return true;
    }
}
