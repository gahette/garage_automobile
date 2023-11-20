<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Repository\CarsRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagesFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function __construct(protected CarsRepository $carsRepository)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $cars = $this->carsRepository->findAll();

        // On construit le chemin de destination des images.
        // En l'état, je n'arrive pas à demander à VichUploader de le faire
        // et suis obligé de le faire "à la main".
        $destination = __DIR__.'/../../public/api/images/';
        // On va se servir du composant "Filesystem" de Symfony pour copier les images depuis le dossier var/
        // vers leur destination finale.
        $filesystem = new Filesystem();

        // on parcourt toutes les voitures
        foreach ($cars as $car) {
            // et on leur ajoute entre 0 et 4 images (environ une recette sur 4 n'auront donc pas d'images).
            for ($i = 0; $i < $this->faker->numberBetween(0, 4); ++$i) {
                // On crée un UploadedFile, pour disposer de quelques méthodes pratiques,
                // mais ça n'est pas nécessaire, on aurait largement pu faire sans.
                $imgFile = $this->createImage();

                // On calcule le dossier de destination.
                // /!\ Attention, le calcul doit être le même que dans src/Namer/ImageDirectoryNamer.php .
                $fileDest = $destination.$car->getSlug();

                // On copie le fichier du dossier var vers sa destination
                // (si on ne copie pas, on va avoir de moins en moins de fichiers, et on en manquera vite ;) ).
                $filesystem->copy($imgFile->getRealPath(), $fileDest.'/'.$imgFile->getFilename());

                // On crée l'entité à persister, en mettant à jour manuellement les propriétés path et size.
                // Normalement, c'est VichUploader qui devraient les remplir automatiquement, c'est là mon souci !
                $image = new Images();
                $image->setPath($imgFile->getFilename());
                $image->setSize($imgFile->getSize());
                $image->setCar($car);

                // On demande à Doctrine (et son ObjectManager) de retenir cette entité comme "à sauvegarder".
                $manager->persist($image);
            }
        }
        // On demande à Doctrine (et son ObjectManager) d'enregistrer en BdD toutes les entités qu'il a en attente.
        $manager->flush();
    }

    // Une méthode pour récupérer une image au hasard dans le dossier var, et nous la renvoie
    // sous la forme d'un objet UploadedFile.
    protected function createImage(): UploadedFile
    {
        $number = $this->faker->numberBetween(1, 16);
        $folder = __DIR__.'/../../var/images/fixtures/';
        $imgName = 'image'.$number.'.jpg';
        $src = $folder.$imgName;

        return new UploadedFile(
            path: $src,
            originalName: $imgName,
            mimeType: 'image/jpeg',
            test: true
        );
    }

    public function getDependencies(): array
    {
        return [
            CarsFixtures::class,
        ];
    }
}
