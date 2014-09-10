<?php

namespace Mov;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;

/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
                		$router[] = $adminRouter = new RouteList('Admin');
        // Admin
        $router[] = new Route('admin/<presenter>/<action>/<id>', array(
            'module' => 'Admin',
            'presenter' => 'Homepage',
            'action' => 'default',
            'id' => NULL,
        ));
		if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
			$router[] = new Route('index.php', 'Front:Homepage:default', Route::ONE_WAY);

			$router[] = $baseRouter = new RouteList('Front');
			$baseRouter[] = new Route('<presenter>/<action>[/<id>]', array(
				'presenter' => 'Homepage',
				'action'        => 'default'
			));

		}else {

			$router = new SimpleRouter('Front:Sign:in');
		}
		return $router;
	}

}

