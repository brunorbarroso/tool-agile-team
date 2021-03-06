import { Injectable } from '@angular/core';
import { environment } from './../../../environments/environment';
import { HttpHeaders, HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { _throw } from 'rxjs/observable/throw';
import { catchError } from 'rxjs/operators';

@Injectable()
export class ApiService {
  constructor(private http: HttpClient) {}

  private formatErrors(error: any) {
    return  _throw(error.errors);
  }
  
  get(path: string, header: HttpHeaders): Observable<any> {
    return this.http.get(`${environment.api_url}${path}`, { headers: header })
      .pipe(catchError(this.formatErrors));
  }

  put(path: string, body: Object = {}, header: HttpHeaders): Observable<any> {
    return this.http.put(
      `${environment.api_url}${path}`,
      JSON.stringify(body), { headers: header }
    ).pipe(catchError(this.formatErrors));
  }

  post(path: string, body: Object = {}, header: HttpHeaders): Observable<any> {
    return this.http.post(
      `${environment.api_url}${path}`,
      JSON.stringify(body), { headers: header }
    ).pipe(catchError(this.formatErrors));
  }

  delete(path): Observable<any> {
    return this.http.delete(
      `${environment.api_url}${path}`
    ).pipe(catchError(this.formatErrors));
  }
}