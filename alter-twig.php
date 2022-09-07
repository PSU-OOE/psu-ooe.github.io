<?php

use Twig\Environment;
use Twig\TwigFunction;

function addCustomExtension(Environment $env) {
    $env->addFunction(new TwigFunction('get_component_stylesheets', function () {
        $styles = [];
        foreach (glob('patterns/**/*/dist/styles.css') as $component) {
            $styles[] = str_replace('patterns', 'css', $component);
        }
        return $styles;
    }));

  $env->addFunction(new TwigFunction('get_component_scripts', function () {
    $scripts = [];
    foreach (glob('patterns/**/*/dist/scripts.js') as $component) {
      $scripts[] = str_replace('patterns', 'js', $component);
    }
    return $scripts;
  }));
}

