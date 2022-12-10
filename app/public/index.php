<?php
require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

$router = new \Klein\Klein();
$controllers = \app\system\Common::getControllersList();

$router->with('/', static function () use ($router, $controllers) {
    foreach ($controllers as $controller) {
        $path = str_replace( \app\system\Common::CONTROLLERS_DIR, API_PREFIX, $controller);
        $path = strtolower(
            str_replace(DIRECTORY_SEPARATOR, '/', $path)
        );

        $router->with($path, static function() use ($router, $controller, $path) {
            $router->respond(
                ['GET','POST'],
                 '*',
                static function (\Klein\Request $request, \Klein\Response $response) use ($controller, $path) {
                    $class = 'app\\' . str_replace(DIRECTORY_SEPARATOR, '\\', $controller);
                    $controller = new $class($request, $response);
                    $method = str_replace('/' . $path . '/', '', $request->pathname());
                    $controller->$method();
                }
            );
        });
    }
});
$router->dispatch();
