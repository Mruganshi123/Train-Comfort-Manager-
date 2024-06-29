import { ApplicationConfig } from '@angular/core';
import { provideRouter, withComponentInputBinding } from '@angular/router';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';

export const appConfig: ApplicationConfig = {
  providers: [
    provideRouter(
      [
        { path: '', component: AppComponent },
        { path: 'login', component: LoginComponent }
      ],
      withComponentInputBinding()
    )
  ]
};
