<?php
/**
 * @link https://github.com/brussens/yii2-maintenance-mode
 * @copyright Copyright (c) since 2015 Dmitry Brusensky
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace brussens\maintenance\filters;

use dmstr\web\User;
use yii\console\Exception;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Class RoleFilter
 * @package brussens\maintenance\filters
 */
class RoleRouteFilter extends RoleFilter
{
    /**
     * @var array
     */
    public $routes;

    /**
     * @var string
     */
    protected $currentRoute;


    /**
     * RoleChecker constructor.
     *
     * @param array $config
     *
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function __construct(array $config = [])
    {
        $this->currentRoute = Yii::$app->getRequest()->resolve()[0];
        parent::__construct(Yii::$app->getUser(), $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (is_string($this->routes)) {
            $this->routes = [$this->routes];
        }
        parent::init();
    }

    /**
     * @return bool
     */
    public function isAllowed()
    {
        $isAllowed = parent::isAllowed();
        if (($isAllowed === false) && is_array($this->routes) && !empty($this->routes)) {
            return in_array($this->currentRoute, $this->routes, true);
        }

        return $isAllowed;
    }
}
