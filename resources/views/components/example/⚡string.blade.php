<?php

use Livewire\Component;
use Symfony\Component\Process\Process;

new class extends Component
{
    public $content;
    public $output;

    public function submitCode()
    {
        $code = $this->sanitizeCode($this->content);

        $process = new Process(['./frankenphp', 'php-cli', '-r', $code]);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            // Handle error
            $error = $process->getErrorOutput();
            dd('Error: ' . $error);
        }

        $this->output = $process->getOutput();
    }

    private function sanitizeCode(string $code): string
    {
        // Remove opening PHP tags (<?php or <?) from the beginning
        $code = preg_replace('/^<\?php\s*/i', '', $code);
        $code = preg_replace('/^<\?\s*/', '', $code);

        // Remove closing PHP tag from the end
        $code = preg_replace('/\s*\?' . '>$/', '', $code);

        return $code;
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