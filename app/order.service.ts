import { Injectable } from '@angular/core';

import { Order } from './order';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';

// onSubmit from app.component.ts calls sendOrder() in order.service.ts
// sendOrder() calls sendRequest()
// sendRequest() constructs a request and then send it to the back
// sendOrder() executes and sends to the backend when onSubmit() subscribes it

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  constructor(private http: HttpClient ) { }

  sendRequest(data: any): Observable<any>{
    // By default responseType is json format
    // return this.http.post('http://localhost/inclass11/ngphp-post.php', data, {responseType: 'json'});
    // return this.http.post('http://localhost/inclass11/ngphp-post.php', data, {responseType: 'text'});
    return this.http.post('http://localhost/inclass11/ngphp-post.php', data);
  }

  sendOrder(data): Observable<Order> {
    return this.sendRequest(data);
  }
}
