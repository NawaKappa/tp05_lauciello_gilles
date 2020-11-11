import { Component, NgZone, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, ActivatedRouteSnapshot, ActivationStart, Router } from '@angular/router';
import { ClientApiService } from 'src/app/services/client-api.service';
import { Utilisateur } from 'src/app/shared/Models/utilisateur';
import { Location } from "@angular/common";
import { filter } from 'rxjs/operators';


@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  constructor(private service: ClientApiService, private router: Router) { }

  login: string;
  pwd: string;

  ngOnInit(): void {
  }

  connexion(){

    let user: Utilisateur = new Utilisateur();
    user.login = this.login;
    user.password = this.pwd;

    this.service.login(user);
  
    this.router.navigate(['/']);
  }

}
