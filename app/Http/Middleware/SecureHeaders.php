<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SecureHeaders
{
    /**
     * Enumerate headers which you do not want in your application's responses.
     * Great starting point would be to go check out @Scott_Helme's:
     * https://securityheaders.com/
     *
     * @var string[]
     */
    private array $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);

        $response = $next($request);

        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'self' 'unsafe-inline' https://use.fontawesome.com/; font-src 'self' https://fonts.gstatic.com/ https://use.fontawesome.com/; img-src 'self' data:; script-src 'self' 'unsafe-inline'; script-src-elem 'self' 'unsafe-inline'; frame-src *;");
        $response->headers->set('Permissions-Policy', 'geolocation=(self ""), microphone=()');

        return $response;
    }

    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}
