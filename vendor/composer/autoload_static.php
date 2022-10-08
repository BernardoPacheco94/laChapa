<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit473d814096677ab862796ece5ac77861
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LaChapa\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LaChapa\\' => 
        array (
            0 => __DIR__ . '/..' . '/lachapa/php-classes/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit473d814096677ab862796ece5ac77861::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit473d814096677ab862796ece5ac77861::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit473d814096677ab862796ece5ac77861::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit473d814096677ab862796ece5ac77861::$classMap;

        }, null, ClassLoader::class);
    }
}
