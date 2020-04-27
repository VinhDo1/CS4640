import { Injectable } from '@angular/core';

import { Register } from './register';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {

  constructor(private http: HttpClient ) { }

  sendRequest(data: any): Observable<any>{
    return this.http.post('http://localhost:81/cs4640/ng.php', data);
    // return this.http.get(`${this.baseUrl}/lobby.php`)
  }

  sendOrder(data): Observable<Register> {
    return this.sendRequest(data);
  }
}
