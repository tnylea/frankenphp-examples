<?php

use Livewire\Component;
use Symfony\Component\Process\Process;

new class extends Component
{
    public string $layout = '<html>
    <head>
        <title>Layout</title>
    </head>
<body>
    {{ $slot }}
</body>
</html>';

    public string $content = '<x-layouts.app>
    <h1>Layouts with Frankenphp</h1>
    <p>We can easily render layouts with an isolated php environment</p>
</x-layouts.app>';

    public string $output = '';

    public function submitCode()
    {
        $layoutPath = tempnam(sys_get_temp_dir(), 'layout_') . '.php';
        $mainPath = tempnam(sys_get_temp_dir(), 'main_') . '.php';

        try {
            // Extract slot content from between <x-layouts.app> tags
            $slotContent = $this->extractSlotContent($this->content);

            // Convert {{ $slot }} to PHP echo
            $phpOpen = '<' . '?php';
            $phpClose = '?' . '>';
            $layoutPhp = str_replace('{{ $slot }}', $phpOpen . ' echo $slot; ' . $phpClose, $this->layout);

            // Write the layout file
            file_put_contents($layoutPath, $layoutPhp);

            // Create main PHP file that includes the layout
            // Use base64 encoding to safely pass HTML content
            $encodedSlot = base64_encode($slotContent);
            $mainPhp = $phpOpen . "\n\$slot = base64_decode('{$encodedSlot}');\ninclude '{$layoutPath}';";

            file_put_contents($mainPath, $mainPhp);

            // Execute with FrankenPHP
            $process = new Process(['./frankenphp', 'php-cli', $mainPath]);
            $process->setWorkingDirectory(base_path());
            $process->run();

            if (!$process->isSuccessful()) {
                $this->output = 'Error: ' . $process->getErrorOutput();
            } else {
                $this->output = $process->getOutput();
            }
        } finally {
            // Clean up temporary files
            @unlink($layoutPath);
            @unlink($mainPath);
        }
    }

    private function extractSlotContent(string $content): string
    {
        // Match content between <x-layouts.app> and </x-layouts.app>
        if (preg_match('/<x-layouts\.app>(.*?)<\/x-layouts\.app>/s', $content, $matches)) {
            return trim($matches[1]);
        }

        return $content;
    }
};
?>

<div class="flex flex-col gap-5">
    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Layout Template</label>
            <div class="h-[300px] w-full rounded-lg overflow-hidden border">
                <x-code-editor wire:model="layout" :content="$layout"></x-code-editor>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
            <div class="h-[300px] w-full rounded-lg overflow-hidden border">
                <x-code-editor wire:model="content" :content="$content"></x-code-editor>
            </div>
        </div>
    </div>
    <x-button wire:click="submitCode">Render Output</x-button>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Output</label>
        <pre class="bg-gray-100 p-4 rounded-lg overflow-auto">{{ $output }}</pre>
    </div>
</div>
