<?php

if(Director::isDev()) {
    Config::inst()->update('Ntb\RestAPI\BaseRestController', 'https_only', false);
}