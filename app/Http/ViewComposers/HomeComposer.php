<?php
namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Repositories\Repository;
use Illuminate\View\View;
use function GuzzleHttp\Promise\all;

class HomeComposer {

    public $cate = [];

    public function __construct(Category $cate)
    {
        $this->cate = new Repository($cate);
    }

    public function compose(View $view)
    {
        $view->with('cate', end($this->cate)->all());
    }
}
