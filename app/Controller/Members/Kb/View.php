<?php
/**
 * Created by: MinutePHP framework
 */

namespace App\Controller\Members\Kb {

    use Minute\Routing\RouteEx;
    use Minute\View\Helper;

    class View {

        public function index(RouteEx $_route) {
            return (new \Minute\View\View())->with(new Helper('Markdown'));
        }
    }
}