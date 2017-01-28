<?php
/**
 * Created by: MinutePHP framework
 */
namespace App\Controller\Members\Support {

    use Minute\Routing\RouteEx;
    use Minute\View\Helper;
    use Minute\View\View;

    class TicketsEdit {

        public function index (RouteEx $_route) {
            return (new View())->with(new Helper('Detect.php'))->with(new Helper('SwfObject.php'));
        }
	}
}