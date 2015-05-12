<?php namespace App\Middleware;


class Csrf extends \Eg\Middleware\Middleware
{

    // private $negotiator;
    // public function __construct(FormatNegotiator $negotiator = null)
    // {
    //     $this->negotiator = $negotiator ?: new FormatNegotiator();
    // }



    public function call()
    {
        
        //var_dump($this->Request->request->all());
        if($this->Request->request->count() > 0)
        {
            if (\Eg\Middleware\CSRF::validate($this->Request->request->all())) {
                // good token
                    
            } else {

                    throw new \Exception("Your request is wrong!!!");
            }
        }

    }

}





?>