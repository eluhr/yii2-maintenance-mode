<?php

namespace brussens\maintenance\states;

use brussens\maintenance\StateInterface;
use yii\base\BaseObject;
use Yii;

class SettingsState extends BaseObject implements StateInterface
{

    /**
     * @var string
     */
    public $section = 'maintenance';

    /**
     * @var string
     */
    public $key = 'enabled';


    /**
     * @inheritdoc
     */
    public function enable()
    {
        Yii::$app->settings->set($this->key, true, $this->section, 'boolean');
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        Yii::$app->settings->set($this->key, false, $this->section, 'boolean');
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return Yii::$app->settings->get($this->key, $this->section, false);

    }
}
