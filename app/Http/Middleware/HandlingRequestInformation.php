<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HandlingRequestInformation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $extension = $request->file->extension();
            $temp_file = $request->file('file')->store('tmp');
            $file = Storage::disk('local')->get($temp_file);


            if (!in_array($extension, array('xml', 'json'))) {
                throw new Exception();
            }

            if ($extension == 'xml') {
                $xml = simplexml_load_string($file);
                $file = json_encode($xml);
            }

            $new_products = json_decode($file, TRUE);
            $products = reset($new_products);

            $request->request->add(['products' => $products]);

            return $next($request);
        } catch (\Throwable $th) {
            return response()->json(array('error' => 'File not found or invalid type (accepts JSON or XML)'), 400);
        }
    }
}
