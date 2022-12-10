<?php

namespace app\modules\common;

use app\system\Common;
use Auryn\ConfigException;
use Auryn\Injector;
use Auryn\Reflector;

class DI extends Injector
{
    private static ?DI $instance = null;

    /**
     * @throws ConfigException
     */
    public function __construct(Reflector $reflector = null)
    {
        parent::__construct($reflector);

        $defs =  require_once Common::getRoot() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'di.php';
        foreach (array_keys($defs) as $interface) {
            $this->alias($interface, $defs[$interface]);
        }
    }

    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new DI();
        }
        return self::$instance;
    }
}