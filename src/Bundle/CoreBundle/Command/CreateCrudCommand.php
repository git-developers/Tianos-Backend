<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

//https://symfony.com/doc/current/components/yaml.html
//https://symfony.com/doc/current/doctrine/reverse_engineering.html
//doctrine:mapping:import

class CreateCrudCommand extends ContainerAwareCommand
{

    const DUMMY_UPPER = 'DUMMY_UPPER';

    protected function configure()
    {
        $this
            ->setName('tianos:create:crud')
            ->setDescription('Crud capitalized')
            ->addOption('baz', 'tn', InputOption::VALUE_NONE, 'Test option')
//            ->addArgument('status', InputArgument::OPTIONAL, 'El status: e.g. TRUE - FALSE', false)
            ->addArgument('bundle', InputArgument::OPTIONAL, 'The component: product, client', false)
        ;
    }

    /**
     * Execute the command
     * The environment option is automatically handled.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bundle = $input->getArgument('bundle');
        $bundle = strtolower($bundle);
        $bundle = ucfirst($bundle);

        $output->writeln([
            '<comment>=========== <question>Directory Copy:</question> proceso ... ===========</comment>',
            '--',
        ]);

        $src = getcwd() . '/src/Bundle/DUMMY_UPPERBundle';
        $dest = getcwd() . '/src/Bundle/' . $bundle . 'Bundle';

        $this->recurseCopy($src, $dest);
        $this->linuxCommand('chown -R 1000:1000 ' . getcwd() . '/src/Bundle/' . $bundle . 'Bundle');
        $this->recurseRenameDirectory($dest, $bundle);
//        $this->recurseRenameFiles($dest, $bundle);
//        $this->recursiveChownAndChgrp($dest);

        $output->writeln('--');
        $output->writeln('<info>* Se termino de crear:</info>');
        $output->writeln('--');

    }

    private function linuxCommand($command) {

        $process = new Process($command);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }

    private function recurseCopy($src, $dest) {
        $dir = opendir($src);
        @mkdir($dest);

        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurseCopy($src . '/' . $file,$dest . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dest . '/' . $file);
                }
            }
        }

        closedir($dir);
    }

    private function recurseRenameDirectory($src, $bundle) {

        $dir = opendir($src);

        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {

                $path = $src . '/' . $file;

                if ( is_dir($path) ) {

                    $this->recurseRenameDirectory($path, $bundle);

                    $explode = explode(DIRECTORY_SEPARATOR, $path);
                    $end = end($explode);

                    if (strpos($end, self::DUMMY_UPPER) !== false) {

                        $newname = str_replace(self::DUMMY_UPPER, $bundle, $path);

                        rename($path, $newname);
                    }

                }
            }
        }

        closedir($dir);
    }

    private function recurseRenameFiles($src, $bundle) {

        $dir = opendir($src);

        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurseRenameFiles($src . '/' . $file, $bundle);
                }
                else {

                    $oldname = $src . '/' . $file;
                    $newname = str_replace(self::DUMMY_UPPER, $bundle, $oldname);

                    rename($oldname, $newname);
                }
            }
        }

        closedir($dir);
    }

/*    private function recursiveChmod ($path, $filePerm = 0644, $dirPerm = 0755)
    {
        // Check if the path exists
        if (!file_exists($path)) {
            return(false);
        }

        // See whether this is a file
        if (is_file($path)) {
            // Chmod the file with our given filepermissions
            chmod($path, $filePerm);

            // If this is a directory...
        } elseif (is_dir($path)) {
            // Then get an array of the contents
            $foldersAndFiles = scandir($path);

            // Remove "." and ".." from the list
            $entries = array_slice($foldersAndFiles, 2);

            // Parse every result...
            foreach ($entries as $entry) {
                // And call this function again recursively, with the same permissions
                $this->recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
            }

            // When we are done with the contents of the directory, we chmod the directory itself
            chmod($path, $dirPerm);
        }

        // Everything seemed to work out well, return true
        return(true);
    }*/


}




