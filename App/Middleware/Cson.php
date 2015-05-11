<?php namespace App\Middleware;


//use Negotiation\FormatNegotiator;



class Cson extends \Elegant\Middleware\Middleware
{

    // private $negotiator;
    // public function __construct(FormatNegotiator $negotiator = null)
    // {
    //     $this->negotiator = $negotiator ?: new FormatNegotiator();
    // }



    public function call($request)
    {
        //$request->uri();
        //var_dump($request);
        //var_dump();
        //die('error');
        //$env        = $this->app->environment;
        //var_dump($env);
        //$accept     = isset($env['HTTP_ACCEPT']) ? $env['HTTP_ACCEPT'] : '';
        //$priorities = isset($env['negotiation.priorities']) ? $env['negotiation.priorities'] : array();
        //$env['request.best_format'] = $this->negotiator->getBestFormat($accept, $priorities);

        //传递视图
        //$this->next->call();
    }

}





?>