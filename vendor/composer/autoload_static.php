<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26ee95b80d3acb7e4e59b8f92b948a53
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phalcon\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phalcon\\' => 
        array (
            0 => __DIR__ . '/..' . '/phalcon/breadcrumbs/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26ee95b80d3acb7e4e59b8f92b948a53::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26ee95b80d3acb7e4e59b8f92b948a53::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}