<?php
require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

$router = new \Klein\Klein();
$controllers = \app\system\Common::getControllersList();
$logger = new \Monolog\Logger('system');
$logger->pushHandler(
    new \Monolog\Handler\StreamHandler(__DIR__ . '/../../logs/system.log', \Monolog\Logger::INFO)
);

$router->with('/', static function () use ($router, $controllers, $logger) {
    foreach ($controllers as $controller) {
        $path = str_replace( \app\system\Common::CONTROLLERS_DIR, API_PREFIX, $controller);
        $path = strtolower(
            str_replace(DIRECTORY_SEPARATOR, '/', $path)
        );

        $router->with($path, static function() use ($router, $controller, $path, $logger) {
            $router->respond(
                ['GET','POST'],
                 '*',
                static function (\Klein\Request $request, \Klein\Response $response) use ($controller, $path, $logger) {
                    $class = 'app\\' . str_replace(DIRECTORY_SEPARATOR, '\\', $controller);
                    $controller = new $class($request, $response);

                    try {
                        $method = str_replace('/' . $path . '/', '', $request->pathname());
                        $controller->$method();
                    } catch (Exception $e) {
                        $json = json_encode([
                            'message' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        $logger->error($json);
                        return 'System error';
                    }
                }
            );
        });
    }
});
$router->dispatch();
