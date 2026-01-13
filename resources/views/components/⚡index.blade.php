<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="flex flex-col gap-5">
    <p>
This is an isolated PHP playground. Any PHP code run here is completely sandboxed and does not execute within the Laravel application itself. In the root of the app is a single <code>frankenphp</code> binary, which is used to execute all example code. Each submission is passed to am isolated PHP process, ensuring the code runs independently without access to the application’s database, session, or Laravel services.
</p>

<p>
<a href="https://frankenphp.dev" class="underline text-blue-500">FrankenPHP</a> is a modern PHP server distributed as a standalone binary. When you click <strong>Render Output</strong>, the code is executed via <code>./frankenphp php-cli -r "your code"</code>. The resulting output is captured and returned directly to the playground.
</p>

<p>
This architecture provides strong isolation and safety guarantees. Each execution starts with a clean slate, no state is preserved between runs, and errors or malformed input cannot affect the main Laravel application. In practice, this acts like PHP running inside PHP, with Laravel coordinating secure, disposable executions behind the scenes.
</p>
</div>