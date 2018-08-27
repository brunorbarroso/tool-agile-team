import { Component, OnInit } from '@angular/core';
import { UserService } from './../shared/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})

export class ProfileComponent implements OnInit {
  today: number = Date.now();
  user: any;

  constructor(private userService: UserService) { }

  ngOnInit() {
    this.userService.fetchUser().subscribe(
      (data: any) => {
        var tmpUser = data;
        this.user = tmpUser;
      });
  }

}
