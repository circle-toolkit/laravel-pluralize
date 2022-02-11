<?php

use Medinam\LaravelPluralize\PluralizeHelper;

if (! function_exists('trans_pluralize')) {
    function trans_pluralize(?string $singular = null) {
        return new PluralizeHelper($singular);
    }
}
