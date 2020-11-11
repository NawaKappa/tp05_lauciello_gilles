import { Component, OnInit } from "@angular/core";
import { Observable } from "rxjs";
import { Store } from "@ngxs/store";
import { ProductState } from "../shared/states/ProductState";
import { ClientApiService } from '../services/client-api.service';

@Component({
  selector: "app-navbar",
  templateUrl: "./navbar.component.html",
  styleUrls: ["./navbar.component.css"]
})
export class NavbarComponent implements OnInit {
  constructor(private store: Store) {}
  nbProductsInBasket$: Observable<number>;


  ngOnInit() {
    this.nbProductsInBasket$ = this.store.select(
      ProductState.getNbProductsInBasket
    );
  }
}
