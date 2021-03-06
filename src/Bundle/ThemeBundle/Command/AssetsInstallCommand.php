<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Command;

use Bundle\ThemeBundle\Asset\Installer\AssetsInstallerInterface;
use Bundle\ThemeBundle\Asset\Installer\OutputAwareInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command that places themes web assets into a given directory.
 */
final class AssetsInstallCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('sylius:theme:assets:install')
            ->setDefinition([
                new InputArgument('target', InputArgument::OPTIONAL, 'The target directory', 'web'),
            ])
            ->addOption('symlink', null, InputOption::VALUE_NONE, 'Symlinks the assets instead of copying it')
            ->addOption('relative', null, InputOption::VALUE_NONE, 'Make relative symlinks')
            ->setDescription('Installs themes web assets under a public web directory')
            ->setHelp($this->getHelpMessage())
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException When the target directory does not exist or symlink cannot be used
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $assetsInstaller = $this->getContainer()->get('sylius.theme.asset.assets_installer');
        if ($assetsInstaller instanceof OutputAwareInterface) {
            $assetsInstaller->setOutput($output);
        }

        $symlinkMask = AssetsInstallerInterface::HARD_COPY;

        if ($input->getOption('symlink')) {
            $symlinkMask = max($symlinkMask, AssetsInstallerInterface::SYMLINK);
        }

        if ($input->getOption('relative')) {
            $symlinkMask = max($symlinkMask, AssetsInstallerInterface::RELATIVE_SYMLINK);
        }

        $assetsInstaller->installAssets($input->getArgument('target'), $symlinkMask);
    }

    /**
     * @return string
     */
    private function getHelpMessage(): string
    {
        return <<<EOT
The <info>%command.name%</info> command installs theme assets into a given
directory (e.g. the <comment>web</comment> directory).

  <info>php %command.full_name% web</info>

A "themes" directory will be created inside the target directory.

To create a symlink to each theme instead of copying its assets, use the
<info>--symlink</info> option (will fall back to hard copies when symbolic links aren't possible):

  <info>php %command.full_name% web --symlink</info>

To make symlink relative, add the <info>--relative</info> option:

  <info>php %command.full_name% web --symlink --relative</info>

EOT;
    }
}
