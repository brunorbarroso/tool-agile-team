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
    var header = new HttpHeaders({});
    const body: User = {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation
    }
    return this.apiService.post(`/auth/register`, body, header);
  }


  attemptAuth(email, password) {
    var header = new HttpHeaders({'Content-Type':'application/json'});
    const body = {
      email: email,
      password: password,
    }
    return this.apiService.post(`/auth/login`, body, header);
  }

  fetchUser(){
    var header = new HttpHeaders({'Content-Type':'application/json'});
    const body = {
      token: localStorage.getItem('userToken')
    }
    
    return this.apiService.post(`/auth/me`, body, header);
  }

}