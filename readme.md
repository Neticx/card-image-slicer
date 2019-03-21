###################
Card Image Slicer
###################

Implementation of capture -> crop -> upload images. in this case is ID card.
statically crop based on Canvas Context ```.drawImage(source,sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight)```

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

Apache2/Nginx with SSL

Chrome camera's can't play with non-secure site.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide. The image slicer is on the welcome page.

*******
License
*******
MIT License
