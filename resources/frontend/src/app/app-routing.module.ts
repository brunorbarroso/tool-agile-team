import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from './auth/auth.guard';
import { SignUpComponent } from './user/sign-up/sign-up.component';
import { SignInComponent } from './user/sign-in/sign-in.component';
import { UserComponent } from './user/user.component';
import { HomeComponent } from './home/home.component';

export const routes: Routes = [
    {
        path: 'dashboard', component: HomeComponent, canActivate: [AuthGuard]
    },
    {
        path: 'account/register', component: UserComponent,
        children: [{path: '', component: SignUpComponent}]
    },
    {
        path: 'account/login', component: UserComponent,
        children: [{path: '', component: SignInComponent}]
    },
    {
        path: '', redirectTo:'account/login', pathMatch: 'full'
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
  })
export class AppRoutingModule { }