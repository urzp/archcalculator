<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5569ed0aa3ebefbb7a2ba09852629ed
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'setasign\\Fpdi\\' => 14,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
        'A' => 
        array (
            'Atgp\\FacturX\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'setasign\\Fpdi\\' => 
        array (
            0 => __DIR__ . '/..' . '/setasign/fpdi/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Atgp\\FacturX\\' => 
        array (
            0 => __DIR__ . '/..' . '/atgp/factur-x/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Smalot\\PdfParser\\' => 
            array (
                0 => __DIR__ . '/..' . '/smalot/pdfparser/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FPDF' => __DIR__ . '/..' . '/setasign/fpdf/fpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5569ed0aa3ebefbb7a2ba09852629ed::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5569ed0aa3ebefbb7a2ba09852629ed::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf5569ed0aa3ebefbb7a2ba09852629ed::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf5569ed0aa3ebefbb7a2ba09852629ed::$classMap;

        }, null, ClassLoader::class);
    }
}
