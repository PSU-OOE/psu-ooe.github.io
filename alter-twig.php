<?php

use Twig\Environment;
use Twig\TwigFunction;

require_once('node_modules/@psu-ooe/smart-datetime/SmartDatetime.php');


function addCustomExtension(Environment $env) {
  $env->addExtension(new SmartDatetimeExtension);
  $env->addFunction(new TwigFunction('get_component_stylesheets', function () {
    $styles = '';
    foreach (glob('node_modules/@psu-ooe/*/dist/styles.css') as $component) {
      $styles .= file_get_contents($component);
    }
    return $styles;
  }));

    $env->addFunction(new TwigFunction('get_component_scripts', function () {
        $scripts = '';
        foreach (glob('node_modules/@psu-ooe/*/dist/scripts.js') as $component) {
            $scripts .= file_get_contents($component);
        }
        return $scripts;
    }));

    $env->addFunction(new TwigFunction('get_sprites', function() {
        return file_get_contents('node_modules/@psu-ooe/sprite/dist/sprites.svg');
    }));
}

