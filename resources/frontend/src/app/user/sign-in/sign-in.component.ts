import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { UserService } from './../shared/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.component.html',
  styleUrls: ['./sign-in.component.css']
})
export class SignInComponent implements OnInit {

  isLoginError: boolean = false;

  constructor(private userService: UserService, private router: Router) { }

  ngOnInit() {
  }

  OnSubmit(email,password){
    this.userService.attemptAuth(email, password)
      .subscribe((data: any)=>{
        localStorage.setItem('userToken', data.access_token);
        this.router.navigate(['/dashboard']);
      },
      (err: HttpErrorResponse)=> {
        this.isLoginError = true;
      }
    )
  }

}
