import { Routes } from '@angular/router';
import { SignUpComponent } from './user/sign-up/sign-up.component';
import { SignInComponent } from './user/sign-in/sign-in.component';
import { UserComponent } from './user/user.component';
import { HomeComponent } from './home/home.component';

export const appRoutes: Routes = [
    {
        path: 'home', component: HomeComponent
    },
    {
        path: 'register', component: UserComponent,
        children: [{path: '', component: SignUpComponent}]
    },
    {
        path: 'login', component: UserComponent,
        children: [{path: '', component: SignInComponent}]
    },
    {
        path: '', redirectTo:'/login', pathMatch: 'full'
    }
];