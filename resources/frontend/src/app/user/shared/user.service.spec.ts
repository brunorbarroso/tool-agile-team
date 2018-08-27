import { ApiService } from './../../core/services/api.services';
import { TestBed, inject } from '@angular/core/testing';
import { HttpClient, HttpHandler } from '@angular/common/http';
import { UserService } from './user.service';
import { Observable } from 'rxjs';
import { _throw } from 'rxjs/observable/throw';
import { catchError } from 'rxjs/operators';

describe('Validar serviço de autenticação', () => {

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ApiService, UserService, HttpClient, HttpHandler]
    });
  });

  it('Usuário e senha válidos', inject([UserService, HttpClient], (service: UserService) => {
    expect(service.attemptAuth('brunobinfo@gmail.com', 'djbrb321')).toBeTruthy();
  }));

  it('Usuário ou senha válido(s)', inject([UserService, HttpClient], (service: UserService) => {
    expect(service.attemptAuth('brunobinfo@gmail.com', '000')).toBeFalsy();
  }));

});