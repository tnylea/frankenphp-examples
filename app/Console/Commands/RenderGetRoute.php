<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

class RenderGetRoute extends Command
{
    protected $signature = 'render:get {url : The GET route to render (e.g. / or /about)}';
    protected $description = 'Render a Laravel GET route and return the HTML output.';

    public function handle()
    {
        $url = $this->argument('url');

        // Ensure leading slash
        if ($url[0] !== '/') {
            $url = '/' . $url;
        }

        /** @var \Illuminate\Contracts\Http\Kernel $kernel */
        $kernel = app(Kernel::class);

        // Create a fake GET request for the route
        $request = Request::create($url, 'GET');

        // Handle the request like a normal web request
        $response = $kernel->handle($request);

        // Output the HTML
        $this->line($response->getContent());

        // Terminate the kernel cleanly
        $kernel->terminate($request, $response);
    }
}