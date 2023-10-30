<?php

namespace Absszero\CommandClassname;

use Illuminate\Console\Command;
use App\Console\Commands\ClassDescriptor;

class ClassnameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'classname
                            {command-name? : Display the command class name}
                            {--path : Display the command class path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all command class names';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $output = $this->getOutput();
        $descriptor = new ClassDescriptor;
        $descriptor->describe($output, $this->getApplication(), [
            'command' => $this->argument('command-name'),
            'path' => $this->option('path'),
        ]);
    }
}
