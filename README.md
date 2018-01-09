Compress images with TinyPNG
============================

Compress all PNG & JPG images within an directory and its subdirectories using the [tinypng.com](https://tinypng.com/) API.

[![Packagist](https://img.shields.io/packagist/v/webit-de/compress-images.svg)](https://packagist.org/packages/webit-de/compress-images/)

Requirements
------------

  * PHP with CLI & CURL modules
  * Composer
  * A [tinyPNG API Key](https://tinypng.com/developers)

Installation
------------

Packagist Entry https://packagist.org/packages/webit-de/compress-images/

    composer create-project webit-de/compress-images .

Usage
-----

    php compress-images.php [input directory] [output directory] [API key]

eg: 

    php compress-images.php /tmp/images/ /tmp/images/ L33T-R2D2

Motivation
----------

This script was made to compress all images recursively in a given directory.

It was meant to be a simple, executable example on how to use the TinyPNG API with PHP.

TinyPNG has a great documentation on how to do more stuff like resizing or
using cloud services as target directory:

  * https://tinypng.com/developers/reference/php

So feel free to use this script as a kickstarter and adapt it to your own needs.

License
-------

GNU General Public License version 2

The GNU General Public License can be found at http://www.gnu.org/copyleft/gpl.html.

Author
------

Dan Untenzu (<untenzu@webit.de> / [@pixelbrackets](https://github.com/pixelbrackets))
for webit! Gesellschaft für neue Medien mbH (http://www.webit.de/)

Changelog
---------

https://github.com/webit-de/compress-images/releases/

Contribution
------------

This PHP project is Open Source, so please use, patch, extend or fork it.
