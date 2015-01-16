<?php

/*
 * Include all routes file
 */
foreach (File::allFiles(__DIR__.'/routes') as $partial) {
    include_once $partial->getPathname();
}