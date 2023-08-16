<?php

namespace App\Namer;

use App\Entity\Images;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ImageDirectoryNamer implements DirectoryNamerInterface
{

    /**
     * @param object|array $object
     * @param PropertyMapping $mapping
     * @return string
     * @throws \Exception
     */
    public function directoryName(object|array $object, PropertyMapping $mapping): string
    {
        $car = $object->getCar();

        if (is_null($car)) {
            throw new \Exception('Car Must not be empty in images');
        }

        return $car->getId();
    }
}