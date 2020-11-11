<?php

interface IClientsRepo{
    public function getRepo();
    public function addClient($client);
    public function getClientInfoByLogin($login);
}