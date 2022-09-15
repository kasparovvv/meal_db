<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\RequestLogger as myLogger;
use Illuminate\Database\QueryException;



class RequestLogger{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        return $next($request);
    }

    public function terminate(Request $request,$response){

        // $data = json_encode(
        //     array(
        //         "start_time"=>date('Y-m-d H:i:s', LARAVEL_START),
        //         "ip"=>$request->ip(),
        //         "parameters"=>$request->all(),
        //         "url"=> $request->path(),
        //         "method"=>$request->method(),
        //         "header"=>$request->header(),
        //         "status code" => $response->getStatusCode(),
        //         "response_bodt"=>$response->getContent()
                
        //     )
        // );


       

        $logger = new myLogger();
        
        $logger->ip = $request->ip();
        $logger->url = $request->path();
        $logger->status_code = $response->getStatusCode();
        $logger->method = $request->method();
        //$logger->start_time = $response->method();
        $logger->body = json_encode($response->getContent());
        $logger->received_at ="test";

        try {

            $logger->save();
    
        } catch (QueryException $e) {
    
            dd($e->getMessage());
    
        }
     
        
    }
}
