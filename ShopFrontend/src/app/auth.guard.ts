import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { ClientApiService } from './services/client-api.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(
    private router: Router,
    private service: ClientApiService
) { }

canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
  //this.service.logout();
    if (this.service.checkTokenValidity()) {
        return true;
    }

    this.router.navigate(['/client/connexion'], { queryParams: { returnUrl: state.url } });
    return false;
}
  
}
