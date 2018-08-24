import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
import { environment } from './../../../environments/environment';
import { User } from './user.model';
import { ApiService } from './../../core/services/api.services';

@Injectable()
export class UserService {

  constructor(private http: HttpClient, private apiService: ApiService) {}

  register(user: User){
    const body: User = {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation
    }
    return this.apiService.post(`/auth/register`, body);
  }

  attemptAuth(email, password) {
    var reqHeader = new HttpHeaders({ 'No-Auth':'True' });
    const body = {
      email: email,
      password: password,
    }
    return this.http.post(`${environment.api_url}/auth/login`, body, { headers: reqHeader});
    return this.apiService.post(`/auth/login`, body);
  }

  getUser(){
    var reqHeader = new HttpHeaders({ 'No-Auth':'True' });
    const body = {
      token: localStorage.getItem('userToken')
    }
    return this.http.post(`${environment.api_url}/auth/me`, body, { headers: reqHeader});
    return this.apiService.post(`/auth/me`, body, reqHeader);
  }

}
