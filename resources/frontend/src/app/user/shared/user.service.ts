import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
import { User } from './user.model';
import { environment } from './../../../environments/environment';

@Injectable()
export class UserService {

  readonly path_uri = 'auth/register';

  constructor(private http: HttpClient) {}

  registerUser(user: User){
    const body: User = {
      name: user.name,
      email: user.email,
      password: user.password,
      password_confirmation: user.password_confirmation
    }
    return this.http.post(`${environment.api_url}/${this.path_uri}`, body);
  }

}
