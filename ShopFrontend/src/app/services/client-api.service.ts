import {HttpClientModule, HttpClient, HttpHeaders, HttpParams, HttpResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import { environment } from 'src/environnements/environnement';
import { Utilisateur } from '../shared/Models/utilisateur';

@Injectable({
  providedIn: 'root'
})
export class ClientApiService {

  constructor(private client: HttpClient) { }

  httpOptions = {
    headers: new HttpHeaders({
    'Content-Type': 'application/json'})};

  public addClient(user: Utilisateur)
  {
    return this.client.post<any>(environment.backendClient + "signin", user, {observe: 'response'})
    .subscribe(response => {
      localStorage.setItem('tokenUser', response.headers.get('Authorization'));
    });
  }

  public login(user: Utilisateur)
  {
    return this.client.post<any>(environment.backendClient + "login", user, {observe: 'response'})
    .subscribe(response => {
      console.log(response);
      localStorage.setItem('tokenUser', response.headers.get('Authorization'));
    });
  }

  public getUser() : Utilisateur
  {
    if(!this.checkTokenValidity())
    {
      return null;
    }
    
    let user = new Utilisateur();
    this.client.get<any>(environment.backendClient + "info", {
      headers: new HttpHeaders().set(
        "Authorization",
        localStorage.getItem('tokenUser')
      ),
      observe: 'response'
    }).subscribe(
      response => {
        Object.assign(user,response.body);
      }
    );
    return user;
  }

  public logout()
  {
    localStorage.removeItem('tokenUser');
  }


  public checkTokenValidity()
  {
    let isValid = true;
    if(!localStorage.getItem('tokenUser'))
    {
      return false;
    }

    this.client.get(environment.backendClient + "auth", {
      headers: new HttpHeaders().set(
        "Authorization",
        localStorage.getItem('tokenUser')
      ),
      observe: 'response'
    }).subscribe(
      error => { isValid = false},
      response => {
        if(response.status == 200)
        {
          isValid = true;
        }
      });

      return isValid;
  }
}
