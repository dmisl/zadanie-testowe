<?php

namespace App\Controller;

use App\Model\Contract;
use App\Model\Klient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;

class ContractController
{
    public function index($request): ResponseInterface 
    {
        $contract_model = new Contract();
        $users = $contract_model->all();

        if(isset($request->getParsedBody()['action']))
        {
            $contracts = $request->getParsedBody()['action'] == 5 ? $contract_model->getAmount($request->getParsedBody()['sort']) : $contract_model->all();
        } else
        {
            $contracts = $contract_model->all();
        }

        ob_start();
        require __DIR__ . '/../View/contract.php';
        $body = ob_get_clean();

        return new Response(200, [], $body);
    }
}