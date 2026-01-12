<?php

use Livewire\Component;
use Symfony\Component\Process\Process;

new class extends Component
{
    public $content;
    public $output;

    public function submitCode()
    {
        $process = new Process(['./frankenphp', 'php-cli', '-r', $this->content]);
        $process->setWorkingDirectory(base_path());
        $process->run();
        
        if (!$process->isSuccessful()) {
            // Handle error
            $error = $process->getErrorOutput();
            dd('Error: ' . $error);
        }
        
        $this->output = $process->getOutput();
    }
};
?>

<div class="flex flex-col gap-5">
    <div class="h-[300px] w-full rounded-lg overflow-hidden">
    <x-code-editor content="" wire:model="content"></x-code-editor>
    </div>
    <x-button wire:click="submitCode">Render Output</x-button>
    <pre>{{ $output }}</pre>
</div>