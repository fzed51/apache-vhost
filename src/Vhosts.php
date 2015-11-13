<?php

/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Fabien SANCHEZ <fzed51@users.noreply.github.com>
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
 * */

namespace fzed51\Apache;

use Exception;
use fzed51\Apache\Vhost\Vhost;

/**
 *
 * */
class Vhosts
{

    private $vhosts;
    
    function __construct(/* string */ $folder)
    {
        $this->vhosts = [];
        $confFiles = glob($folder . DIRECTORY_SEPARATOR . '*.conf');
        print_r($confFiles);
        foreach ($confFiles as $confFile) {
            $this->addVhosts(self::parseConfFile($confFile));
        }        
    }
    
    function addVhosts(Array $vhosts) {
        foreach($vhosts as $vhost){
            $this->addVhost($vhost);
        }
    }
    
    function addVhost(Vhost $vhost){
        if(!isset($this->vhosts[$vhost->getServerName()])){
            $this->vhosts[$vhost->getServerName()] = $vhost;
        } else {
            throw new Exception("le Virtual Host '{$vhost->serverName}' est déclaré 2 fois.");
        }
    }
    
    function update() {
        
    }
    
    static private function parseConfFile($filePath) {
        $content = file_get_contents($filePath);
        return [];
    }
    
}
