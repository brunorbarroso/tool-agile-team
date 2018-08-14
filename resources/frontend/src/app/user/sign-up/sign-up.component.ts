import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { User } from '../shared/user.model';
import { UserService } from '../shared/user.service';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {

  user: User;
  emailPattern = "^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$";

  constructor(private userService: UserService, private toastr: ToastrService) { }

  ngOnInit() {
    this.resetForm();
    setTimeout(() => this.toastr.success('Welcome!'));
  }

  resetForm(form?: NgForm){
    if(form != null)
      form.reset();
    this.user = {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }
  }

  OnSubmit(form: NgForm){
    this.userService.registerUser(form.value).
      subscribe((response: any) => {
        if(response.success == true)
        {
          this.resetForm();
          if(response.data.message !== null){
            this.toastr.success(response.data.message);
          }
        } else {
          var message = [];
          $.each(response.errors, function(label, error) {
            var str = label + ": " + error;
            message.push(str);
          });
          this.toastr.error(message.join(' '))
        }
      });
  }

}
