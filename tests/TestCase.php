<?php

namespace kdn\yii2;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class TestCase.
 * @package kdn\yii2
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Mock Yii application.
     */
    protected function setUp()
    {
        parent::setUp();
        static::mockWebApplication();
    }

    /**
     * Clean up after test.
     * By default the application created with `mockWebApplication` will be destroyed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        static::destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application.
     * The application will be destroyed on tearDown() automatically.
     * @param array $config the application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected static function mockWebApplication($config = [], $appClass = 'yii\web\Application')
    {
        new $appClass(
            ArrayHelper::merge(
                [
                    'id' => 'test-app',
                    'basePath' => __DIR__,
                    'components' => [
                        'assetManager' => [
                            'linkAssets' => true,
                        ],
                        'request' => [
                            'scriptFile' => static::getTestsRuntimePath() . '/index.php',
                            'scriptUrl' => '/index.php',
                        ],
                    ],
                    'vendorPath' => static::getVendorPath(),
                ],
                $config
            )
        );
    }

    /**
     * Get path to "vendor" directory.
     * @return string path to "vendor" directory.
     */
    protected static function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Get path to tests "runtime" directory.
     * @return string path to tests "runtime" directory.
     */
    protected static function getTestsRuntimePath()
    {
        return __DIR__ . '/runtime';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected static function destroyApplication()
    {
        Yii::$app = null;
    }

    /**
     * Asserts that the contents of a string is equal to the contents of a HTML file.
     * @param string $methodName name of test method
     * @param string $actualString
     * @param string $message
     * @param bool $canonicalize
     * @param bool $ignoreCase
     */
    public static function assertStringEqualsHtmlFile(
        $methodName,
        $actualString,
        $message = '',
        $canonicalize = false,
        $ignoreCase = false
    ) {
        static::assertStringEqualsFile(
            __DIR__ . "/expected/$methodName.html",
            $actualString,
            $message,
            $canonicalize,
            $ignoreCase
        );
    }

    /**
     * Asserts that the contents of a string is equal to the contents of a JavaScript file.
     * @param string $methodName name of test method
     * @param string $actualString
     * @param string $message
     * @param bool $canonicalize
     * @param bool $ignoreCase
     */
    public static function assertStringEqualsJsFile(
        $methodName,
        $actualString,
        $message = '',
        $canonicalize = false,
        $ignoreCase = false
    ) {
        static::assertStringEqualsFile(
            __DIR__ . "/expected/$methodName.js",
            $actualString,
            $message,
            $canonicalize,
            $ignoreCase
        );
    }
}
