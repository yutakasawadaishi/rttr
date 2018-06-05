<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit483fe17a35bdc3adb67bb520bedd1d14
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
    );

    public static $classMap = array (
        'Firebase\\Error' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseStub.php',
        'Firebase\\FirebaseInterface' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseInterface.php',
        'Firebase\\FirebaseLib' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseLib.php',
        'Firebase\\FirebaseStub' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseStub.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit483fe17a35bdc3adb67bb520bedd1d14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit483fe17a35bdc3adb67bb520bedd1d14::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit483fe17a35bdc3adb67bb520bedd1d14::$classMap;

        }, null, ClassLoader::class);
    }
}