<?php

namespace App\Services;

use App\Entity\Admin;
use App\Entity\Livre;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileUploader
{
    public function __construct(
        private $targetDirectoryLivre,
        private $targetDirectoryApropos,
        private $targetDirectorySecondApropos,
        private $targetDirectoryThirdApropos,
        private $targetDirectoryFirstImageHome,
        private $targetDirectoryImgShortBiographie,
        private $targetDirectoryImgLogo,
        private $targetDirectoryImgLogoTrans,
        private SluggerInterface $slugger,
        private Filesystem $filesystem,
    ) {
    }

    public function uploadLivre(UploadedFile $file, Livre $livre)
    {

        $previousImage = $livre->getCouverture();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryLivre() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryLivre(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    
    public function getTargetDirectoryLivre()
    {
        return $this->targetDirectoryLivre;
    }



    

    public function uploadBiographie(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getImageBiographie();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryApropos() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryApropos(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryApropos()
    {
        return $this->targetDirectoryApropos;
    }





    public function uploadsecondBiographie(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getSecondImageBiographie();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectorySecondApropos() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectorySecondApropos(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectorySecondApropos()
    {
        return $this->targetDirectorySecondApropos;
    }





    public function uploadThirdBiographie(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getImageReseauxSociaux();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryThirdApropos() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryThirdApropos(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryThirdApropos()
    {
        return $this->targetDirectoryThirdApropos;
    }



    public function uploadFirstImageHome(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getFirstimageHome();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryFirstImageHome() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryFirstImageHome(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryFirstImageHome()
    {
        return $this->targetDirectoryFirstImageHome;
    }


    public function uploadimgShortBiographie(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getImgShortBiographie();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryImgShortBiographie() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryImgShortBiographie(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryImgShortBiographie()
    {
        return $this->targetDirectoryImgShortBiographie;
    }

    public function uploadimgLogo(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getImgLogo();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryImgLogo() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryImgLogo(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryImgLogo()
    {
        return $this->targetDirectoryImgLogo;
    }
    public function uploadimgLogoTrans(UploadedFile $file, Admin $admin)
    {


        $previousImage = $admin->getImgLogoTrans();

        // Vérifier si une image précédente existe
        if ($previousImage) {
            // Supprimer l'image précédente
            $filesystem = new Filesystem();
            $filesystem->remove($this->getTargetDirectoryImgLogoTrans() . '/' . $previousImage);
        }

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectoryImgLogoTrans(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
    public function getTargetDirectoryImgLogoTrans()
    {
        return $this->targetDirectoryImgLogoTrans;
    }
}