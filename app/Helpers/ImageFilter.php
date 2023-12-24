<?php

namespace App\Helpers;

use Intervention\Image\Interfaces\ModifierInterface;
use Intervention\Image\Interfaces\ImageInterface;

class ImageFilter implements ModifierInterface
{
    private $blur;

    public function __construct(?int $blur = 0)
    {
        $this->blur = $blur;
    }

    public function apply(ImageInterface $image): ImageInterface
    {
        $image
            ->cover(400, 400)
            ->blur($this->blur)
            ->greyscale()
            ->toJpeg()
            ->save('wp4615510-terminal-wallpapers-filtered.jpg');

        return $image;
    }
}
