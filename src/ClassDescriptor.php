<?php

namespace Absszero\CommandClassname;

use ReflectionClass;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Descriptor\TextDescriptor;
use Symfony\Component\Console\Descriptor\ApplicationDescription;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class ClassDescriptor extends TextDescriptor
{
    protected function describeApplication(Application $application, array $options = [])
    {
        $description = new ApplicationDescription($application);

        $commands = $description->getCommands();
        if ($options['command']) {
            if (isset($commands[$options['command']])) {
                $commands = [$options['command'] => $commands[$options['command']]];
            } else {
                throw new CommandNotFoundException(sprintf('Command "%s" does not exist.', $options['command']));
            }
        }

        // calculate max. width based on available commands per namespace
        $width = $this->getColumnWidth($commands);

        $this->writeText('<comment>Available commands:</comment>');
        $namespaces = $description->getNamespaces();
        foreach ($namespaces as $namespace) {
            $namespace['commands'] = array_filter($namespace['commands'], function ($name) use ($commands) {
                return isset($commands[$name]);
            });

            if (!$namespace['commands']) {
                continue;
            }

            if (ApplicationDescription::GLOBAL_NAMESPACE !== $namespace['id']) {
                $this->writeText("\n");
                $this->writeText(' <comment>'.$namespace['id'].'</comment>');
            }

            foreach ($namespace['commands'] as $name) {
                $this->writeText("\n");
                $spacingWidth = $width - Helper::width($name);
                $command = $commands[$name];
                $commandDescription = get_class($command);
                if ($options['path']) {
                    $reflector = new ReflectionClass($command);
                    $commandDescription = $reflector->getFileName();
                }
                $this->writeText(sprintf('  <info>%s</info>%s%s', $name, str_repeat(' ', $spacingWidth), $commandDescription));
            }
        }

        $this->writeText("\n");
    }

    /**
     * {@inheritdoc}
     */
    private function writeText(string $content)
    {
        $this->write($content, true);
    }

    /**
     * @param array<Command|string> $commands
     */
    private function getColumnWidth(array $commands): int
    {
        $widths = [];

        foreach ($commands as $command) {
            if ($command instanceof Command) {
                $widths[] = Helper::width($command->getName());
                foreach ($command->getAliases() as $alias) {
                    $widths[] = Helper::width($alias);
                }
                continue;
            }
            $widths[] = Helper::width($command);
        }

        return $widths ? max($widths) + 2 : 0;
    }
}
