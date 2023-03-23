<?php defined('BASEPATH') or exit('Pasta raiz não localizada ou inacessível');

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link    http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Config class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Config.php
 *
 * @copyright   Copyright (c) 2015 Wiredesignz
 * @version     5.5
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Config extends CI_Config
{
    /**
     * [load description]
     *
     * @method load
     *
     * @param  string  $file            [description]
     * @param  boolean $use_sections    [description]
     * @param  boolean $fail_gracefully [description]
     * @param  string  $_module         [description]
     *
     * @return [type]                   [description]
     */
    public function load($file = '', $use_sections = false, $fail_gracefully = false, $_module = '')
    {
        if (in_array($file, $this->is_loaded, true)) {
            return $this->item($file);
        }

        $_module or $_module = CI::$APP->router->fetch_module();

        // Backward function
        // Before PHP 7.1.0, list() only worked on numerical arrays and assumes the numerical indices start at 0.
        if (version_compare(phpversion(), '7.1', '<')) {
            // php version isn't high enough
            list($path, $file) = Modules::find($file, $_module, 'config/');
        } else {
            [$path, $file] = Modules::find($file, $_module, 'config/');
        }

        if ($path === false) {
            parent::load($file, $use_sections, $fail_gracefully);
            return $this->item($file);
        }

        if ($config = Modules::load_file($file, $path, 'config')) {
            // reference to the config array
            $current_config =& $this->config;

            if ($use_sections === true) {
                if (isset($current_config[$file])) {
                    $current_config[$file] = array_merge($current_config[$file], $config);
                } else {
                    $current_config[$file] = $config;
                }
            } else {
                $current_config = array_merge($current_config, $config);
            }

            $this->is_loaded[] = $file;
            unset($config);
            return $this->item($file);
        }
    }
}
