<?php
include('IClientService.php');
require_once(dirname(__DIR__).'/Repository/IClientsRepo.php');


class ClientService implements IClientService
{
    private IClientsRepo $repo;

    public function __construct(IClientsRepo $repoCli)
    {
        $this->repo = $repoCli;
    }

    public function getClients()
    {
        $res = $this->repo->getRepo();
        return $res;
    }

    public function getClientInfoByLogin($login)
    {
        return $this->repo->getClientInfoByLogin($login);
    }

    public function loginExists($login)
    {
        $repo = $this->repo->getRepo();
        foreach ($repo as $client) 
        {
            foreach ($client as $value) 
            {
                if($value['login'] == $login)
                {
                    return true;
                }

            }
        }
        return false;
    }

    public function postClient($client)
    {
        $this->repo->addClient($client);
    }
}