import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
import { environment } from './../../../environments/environment';
import { User } from './user.model';

@Injectable()
export class UserService {

  constructor(private http: HttpClient) {}

  registerUser(user: User){
    const body: User = {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation
    }
    return this.http.post(`${environment.api_url}/auth/register`, body);
  }

  authenticationUser(email, password) {
    var reqHeader = new HttpHeaders({ 'No-Auth':'True' });
    const body = {
      email: email,
      password: password,
    }
    return this.http.post(`${environment.api_url}/auth/login`, body, { headers: reqHeader });
  }

  getUserClaims(){
    var reqHeader = new HttpHeaders({ 'No-Auth':'True' });
    const body = {
      token: localStorage.getItem('userToken')
    }
    return this.http.post(`${environment.api_url}/auth/me`, body, { headers: reqHeader });
  }

}
