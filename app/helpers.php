<?php

if (! function_exists('route_api')) {
    /**
     * Generate the URL to a named route in dingo api.
     * @param $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function route_api($name, $parameters = [], $absolute = true)
    {
        return app('Dingo\Api\Routing\UrlGenerator')
            ->version('v1')
            ->route($name, $parameters, $absolute);
    }
}
