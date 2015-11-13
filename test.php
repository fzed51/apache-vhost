<?php

use fzed51\Apache\Vhost\Vhost;
use fzed51\Apache\Vhosts;

require './vendor/autoload.php';

$vhosts = new Vhosts('.\vhosts');

$vSite = new Vhost('local.oracle.tool');

$vhosts->addVhost($vSite);

$vhosts->update();