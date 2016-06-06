<?php
/**
 * @author Petr Grishin <petr.grishin@grishini.ru>
 */

use Grav\Common\Grav;
use Grav\Common\Page\Medium\ImageFile;
use Grav\Common\Page\Medium\ImageMedium;
use Gregwar\Image\Image;

class ImageCollageTwigExtension extends \Twig_Extension
{
    /** @var Grav */
    protected $grav;
    protected $column;
    protected $borderSize;
    protected $width;
    protected $locator;

    public function __construct()
    {
        $this->grav = Grav::instance();
        $this->locator = $this->grav['locator'];
        $this->loadParamsFromConfig([
            'column' => 'column',
            'border_size' => 'borderSize',
            'image_width' => 'width'
        ], 'plugins.image-collage.');
    }

     /**
      * Returns the name of the extension.
      *
      * @return string The extension name
      */
     public function getName() {
         return 'ImageCollageTwigExtension';
     }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('images_collage', [$this, 'imageCollage']),
        ];
    }

    /**
     * @param ImageMedium[] $images
     * @param int $column
     * @param int $borderSize
     * @param int $width
     * @return ImageMedium
     */
    public function imageCollage(array $images, $column = null, $borderSize = null, $width = null)
    {
        is_null($column) && $column = $this->column;
        is_null($borderSize) && $borderSize = $this->borderSize;
        is_null($width) && $width = $this->width;
        $widthImg = $width - $borderSize;
        $cachePath = $this->locator->findResource('cache://images', true);
        $collage = ImageFile::create($widthImg, $widthImg)
            ->setCacheDir($cachePath)
            ->setActualCacheDir($cachePath);
        $collage->rectangle(0, 0, $widthImg, $widthImg, 0xffffff, true);
        $c = 0;
        $r = 0;
        $mergedWidth = $width / $column;
        foreach ($images as $image) {
            $mergedImage = Image::open($image->get('filepath'));
            $mergedImage->zoomCrop($mergedWidth - $borderSize, $mergedWidth - $borderSize);
            $collage->merge($mergedImage, $r * $mergedWidth, $c * $mergedWidth, $mergedWidth - $borderSize, $mergedWidth - $borderSize);
            $c++;
            if ($c % $column == 0) {
                $c = 0;
                $r++;
            }
        }
        $filePath = $collage->cacheFile('jpg', 85);
        $imageMedium = \Grav\Common\Page\Medium\MediumFactory::fromFile($filePath);
        return $imageMedium;
    }

    /**
     * @param array $mapParams
     * @param string $configPrefix
     * @return $this
     */
    protected function loadParamsFromConfig(array $mapParams, $configPrefix) {
        foreach ($mapParams as $nameConfigParam => $nameParam) {
            $this->{$nameParam} = $this->grav['config']->get($configPrefix . $nameConfigParam);
        }
        return $this;
    }
}
