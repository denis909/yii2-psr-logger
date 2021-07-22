<?php

namespace denis909\yii;

use Yii;
use Stringable;
use Psr\Log\LogLevel;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;

class PsrLogger extends \Psr\Log\AbstractLogger
{

    public $defaultContext = [];

    public function __construct(array $defaultContext = [])
    {
        $this->defaultContext = $defaultContext;
    }

    public function log($level, $message, array $context = [])
    {
        $context = ArrayHelper::merge($this->defaultContext, $context);

        $context['message'] = $message;

        if ($level == LogLevel::INFO)
        {
            Yii::info($context, $message);

            return;
        }

        if ($level == LogLevel::DEBUG)
        {
            Yii::debug($context, $message);

            return;
        }

        if ($level == LogLevel::WARNING)
        {
            Yii::warning($context, $message);

            return;
        }

        if ($level == LogLevel::ERROR)
        {
            Yii::error($context, $message);

            return;
        }

        //const EMERGENCY = 'emergency';
        //const ALERT     = 'alert';
        //const CRITICAL  = 'critical';
        //const NOTICE    = 'notice';

        $message = Yii::t('Level ":level" not supported.', [':level' => $level]);

        throw new NotSupportedException($message);
    }

}