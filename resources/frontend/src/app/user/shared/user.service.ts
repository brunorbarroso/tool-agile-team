import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
import { User } from './user.model';
import { environment } from './../../../environments/environment';

@Injectable()
export class UserService {

  readonly uri_register = 'auth/register';
  readonly uri_token = 'auth/login';

  constructor(private http: HttpClient) {}

  registerUser(user: User){
    const body: User = {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation
    }
    return this.http.post(`${environment.api_url}/${this.uri_register}`, body);
  }

  authenticationUser(email, password) {
    const body = {
      email: email,
      password: password,
    }
    return this.http.post(`${environment.api_url}/${this.uri_token}`, body);
  }

}
