<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Absszero\CommandClassname\ClassDescriptor;
use Symfony\Component\Console\Output\BufferedOutput;

class ClassDescriptorTest extends TestCase
{
    public function testDescribeApplication()
    {
        $descriptor = new ClassDescriptor;
        $application = new Application();

        $output = new BufferedOutput(BufferedOutput::VERBOSITY_NORMAL, true);
        $descriptor->describe($output, $application, ['command' => '', 'path' => false]);
        $text = $output->fetch();
        $this->assertStringContainsString('Symfony\\Component\\Console\\Command\\HelpCommand', $text);
        $this->assertStringContainsString('Symfony\\Component\\Console\\Command\\ListCommand', $text);

        // single command
        $descriptor->describe($output, $application, ['command' => 'list', 'path' => false]);
        $text = $output->fetch();
        $this->assertStringNotContainsString('Symfony\\Component\\Console\\Command\\HelpCommand', $text);
        $this->assertStringContainsString('Symfony\\Component\\Console\\Command\\ListCommand', $text);

        // path option
        $descriptor->describe($output, $application, ['command' => 'list', 'path' => true]);
        $path = realpath(__DIR__ . '/../vendor/symfony/console/Command/ListCommand.php');
        $this->assertStringContainsString($path, $output->fetch());
    }
}
