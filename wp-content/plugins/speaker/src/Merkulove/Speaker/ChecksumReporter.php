<?php
/**
 * Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Exclusively on Envato Market: https://1.envato.market/speaker
 *
 * @encoding        UTF-8
 * @version         3.1.0
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\Speaker;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/**
 * SINGLETON: Class create and verify checksum file.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class ChecksumReporter {

    /**
     * The one true ChecksumReporter.
     *
     * @var ChecksumReporter
     * @since 3.0.0
     **/
    private static $instance;

    /**
     * Create file checksums.
     * 
     * @param string $path     
     * @param string $filename 
     *
     * @since 3.0.0
     * @return boolean
     **/
    public function create($path, $filename = 'checksums') {

        $path  = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $path), '/').'/';
        $files = $this->readDirectory($path);

        if (is_array($files)) {
            $checksums = '';

            foreach ($files as $file) {

                // dont include the checksum file itself
                if ($file == $filename) {
                    continue;
                }

                $checksums .= md5_file($path.$file)." {$file}\n";
            }

            return file_put_contents($path.$filename, $checksums);
        }

        return false;
    }

    /**
     * Verify file checksums.
     * 
     * @param string $path     
     * @param array  $log      
     * @param string $filename
     *
     * @since 3.0.0
     * @return boolean
     **/
    public function verify($path, &$log, $filename = 'checksums') {
        $path = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $path), '/').'/';

        if ($rows = file($path.$filename)) {
            foreach ($rows as $row) {
                $parts = explode(' ', trim($row), 2);

                if (count($parts) == 2) {
                    list($md5, $file) = $parts;

                    if (!file_exists($path.$file)) {
                        $log['missing'][] = $file;
                    } elseif (md5_file($path.$file) != $md5) {
                        $log['modified'][] = $file;
                    }
                }
            }
        }

        return empty($log);
    }

    /**
     * Read files form a directory.
     * 
     * @param string  $path      
     * @param string  $prefix    
     * @param boolean $recursive
     *
     * @since 3.0.0
     * @return array            
     **/
    protected function readDirectory( $path, $prefix = '', $recursive = true ) {

        $files  = [];
        $ignore = ['.', '..', '.DS_Store', '.directory', '.svn', '.git', '.gitignore', '.gitmodules', 'cgi-bin'];

        foreach ( scandir( $path ) as $file ) {

            /** Ignore file? */
            if ( in_array( $file, $ignore, false ) ) { continue; }

            /** Get files. */
            if ( is_dir( $path . '/' . $file ) && $recursive ) {

                /** @noinspection SlowArrayOperationsInLoopInspection */
                $files = array_merge( $files, $this->readDirectory( $path . '/' . $file, $prefix . $file . '/', $recursive ) );

            } else {

                $files[] = $prefix . $file;

            }

        }

        return $files;

    }

    /**
     * Main ChecksumReporter Instance.
     *
     * Insures that only one instance of ChecksumReporter exists in memory at any one time.
     *
     * @static
     * @return ChecksumReporter
     * @since 3.0.0
     **/
    public static function get_instance() {

        /** @noinspection SelfClassReferencingInspection */
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ChecksumReporter ) ) {

            /** @noinspection SelfClassReferencingInspection */
            self::$instance = new ChecksumReporter;

        }

        return self::$instance;

    }

}
