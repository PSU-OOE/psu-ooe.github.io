<?php

use Twig\Environment;
use Twig\TwigFunction;

function addCustomExtension(Environment $env) {
    $env->addFunction(new TwigFunction('get_component_stylesheets', function () {
        $styles = [];
        foreach (glob('components/**/*/dist/styles.css') as $component) {
            $styles[] = str_replace('components', 'css', $component);
        }
        return $styles;
    }));

  $env->addFunction(new TwigFunction('get_component_scripts', function () {
    $scripts = [];
    foreach (glob('components/**/*/dist/scripts.js') as $component) {
      $scripts[] = str_replace('components', 'js', $component);
    }
    return $scripts;
  }));

  $env->addFunction(new TwigFunction('get_sprites', function() {
      return file_get_contents('components/atoms/sprite/dist/sprites.svg');
  }));
}

