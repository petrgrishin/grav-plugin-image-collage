# [Grav](http://github.com/getgrav/grav) Image Collage Plugin
Create beautiful image collages for all your posts and pages

![image](assets/example.png)

## Usage
Twig syntax
```php
{{ images_collage(page.media.images).html }}

{{ images_collage(page.media.images|slice(1, 5)).html }} //or slice

{{ images_collage(page.media.images, 3, 5, 900).html }} //or with params
```

Class diagram syntax
```
images_collage(images: ImageMedium[], column: int, borderSize: int, width: int): ImageMedium
```

## Installation

Installing the Image Collage plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install image-collage

This will install the Image Collage plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/image-collage`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `image-collage`. You can find these files either on [GitHub](https://github.com/petrgrishin/grav-plugin-image-collage) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/image-collage

>> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav).
