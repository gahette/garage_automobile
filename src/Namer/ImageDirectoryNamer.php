<?php

namespace App\Namer;

use App\Entity\Images;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

/**
 * @implements DirectoryNamerInterface<Images>
 */
class ImageDirectoryNamer implements DirectoryNamerInterface
{
    /**
     * @param Images $object
     *
     * @throws \Exception
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        $car = $object->getCar();

        if (is_null($car)) {
            throw new \Exception('Car Must not be empty in images');
        }

        return (string) $car->getSlug();
    }
}
