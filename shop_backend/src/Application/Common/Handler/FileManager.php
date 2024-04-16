<?php

declare(strict_types=1);

namespace App\Application\Common\Handler;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileManager
{
    public function __construct(
        private readonly string $targetDirectory,
        private readonly Filesystem $filesystem,
        private readonly SluggerInterface $slugger,
        private readonly ParameterBagInterface $parameterBag,
    ) {
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->targetDirectory, $fileName);
        } catch (FileException $e) {
            throw new \Exception($e->getMessage());
        }

        return $fileName;
    }

    public function remove(string $imageName): void
    {
        $projectDir = $this->parameterBag->get('kernel.project_dir');
        $this->filesystem->remove($projectDir.'/public/uploads/'.$imageName);
    }
}
